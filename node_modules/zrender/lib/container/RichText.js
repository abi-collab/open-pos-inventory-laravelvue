"use strict";
exports.__esModule = true;
var tslib_1 = require("tslib");
var Element_1 = require("../Element");
var parse_1 = require("./text/parse");
var Text_1 = require("../graphic/Text");
var util_1 = require("../core/util");
var text_1 = require("../contain/text");
var Image_1 = require("../graphic/Image");
var Rect_1 = require("../graphic/shape/Rect");
var RichText = (function (_super) {
    tslib_1.__extends(RichText, _super);
    function RichText(opts) {
        var _this = _super.call(this) || this;
        _this.isGroup = true;
        _this._children = [];
        _this._styleChanged = true;
        _this.attr(opts);
        return _this;
    }
    RichText.prototype.update = function () {
        if (this._styleChanged) {
            this._children = [];
            normalizeTextStyle(this.style);
            this.style.rich
                ? this._updateRichTexts()
                : this._updatePlainTexts();
        }
        _super.prototype.update.call(this);
    };
    RichText.prototype.attrKV = function (key, value) {
        if (key !== 'style') {
            _super.prototype.attrKV.call(this, key, value);
        }
        else {
            if (!this.style) {
                this.style = value;
            }
            else {
                this.setStyle(value);
            }
        }
    };
    RichText.prototype.setStyle = function (obj, value) {
        if (typeof obj === 'string') {
            this.style[obj] = value;
        }
        else {
            for (var key in obj) {
                if (obj.hasOwnProperty(key)) {
                    this.style[key] = obj[key];
                }
            }
        }
        this.dirty();
        return this;
    };
    RichText.prototype.dirtyStyle = function () {
        this._styleChanged = true;
        this.dirty();
    };
    RichText.prototype.children = function () {
        return this._children;
    };
    RichText.prototype._addChild = function (child) {
        this._children.push(child);
        child.parent = this;
    };
    RichText.prototype._updatePlainTexts = function () {
        var style = this.style;
        var text = style.text || '';
        var textFont = style.font || text_1.DEFAULT_FONT;
        var textPadding = style.textPadding;
        var textLineHeight = style.textLineHeight;
        var contentBlock = parse_1.parsePlainText(text, textFont, textPadding, textLineHeight, style.truncate);
        var needDrawBg = needDrawBackground(style);
        var outerHeight = contentBlock.outerHeight;
        var textLines = contentBlock.lines;
        var lineHeight = contentBlock.lineHeight;
        var baseX = style.x || 0;
        var baseY = style.y || 0;
        var textAlign = style.textAlign || 'left';
        var textVerticalAlign = style.textVerticalAlign;
        var boxY = text_1.adjustTextY(baseY, outerHeight, textVerticalAlign);
        var textX = baseX;
        var textY = boxY;
        if (needDrawBg || textPadding) {
            var textWidth = text_1.getWidth(text, textFont);
            var outerWidth_1 = textWidth;
            textPadding && (outerWidth_1 += textPadding[1] + textPadding[3]);
            var boxX = text_1.adjustTextX(baseX, outerWidth_1, textAlign);
            needDrawBg && this._renderBackground(style, boxX, boxY, outerWidth_1, outerHeight);
            if (textPadding) {
                textX = getTextXForPadding(baseX, textAlign, textPadding);
                textY += textPadding[0];
            }
        }
        textY += lineHeight / 2;
        var textStrokeWidth = style.textStrokeWidth;
        var textStroke = getStroke(style.textStroke, textStrokeWidth);
        var textFill = getFill(style.textFill);
        var hasStroke = 'textStroke' in style;
        var hasFill = 'textFill' in style;
        var hasShadow = style.textShadowBlur > 0;
        for (var i = 0; i < textLines.length; i++) {
            var el = new Text_1["default"]();
            var subElStyle = el.style;
            subElStyle.text = textLines[i];
            subElStyle.x = textX;
            subElStyle.y = textY;
            if (textAlign) {
                subElStyle.textAlign = textAlign;
            }
            subElStyle.textBaseline = 'middle';
            subElStyle.opacity = style.opacity;
            subElStyle.strokeFirst = true;
            if (hasShadow) {
                subElStyle.shadowBlur = style.textShadowBlur || 0;
                subElStyle.shadowColor = style.textShadowColor || 'transparent';
                subElStyle.shadowOffsetX = style.textShadowOffsetX || 0;
                subElStyle.shadowOffsetY = style.textShadowOffsetY || 0;
            }
            if (hasStroke) {
                subElStyle.stroke = textStroke;
                subElStyle.lineWidth = textStrokeWidth;
            }
            if (hasFill) {
                subElStyle.fill = textFill;
            }
            subElStyle.font = textFont;
            textY += lineHeight;
            this._addChild(el);
        }
    };
    RichText.prototype._updateRichTexts = function () {
        var style = this.style;
        var contentBlock = parse_1.parseRichText(style.text || '', style);
        var contentWidth = contentBlock.width;
        var outerWidth = contentBlock.outerWidth;
        var outerHeight = contentBlock.outerHeight;
        var textPadding = style.textPadding;
        var baseX = style.x || 0;
        var baseY = style.y || 0;
        var textAlign = style.textAlign;
        var textVerticalAlign = style.textVerticalAlign;
        var boxX = text_1.adjustTextX(baseX, outerWidth, textAlign);
        var boxY = text_1.adjustTextY(baseY, outerHeight, textVerticalAlign);
        var xLeft = boxX;
        var lineTop = boxY;
        if (textPadding) {
            xLeft += textPadding[3];
            lineTop += textPadding[0];
        }
        var xRight = xLeft + contentWidth;
        for (var i = 0; i < contentBlock.lines.length; i++) {
            var line = contentBlock.lines[i];
            var tokens = line.tokens;
            var tokenCount = tokens.length;
            var lineHeight = line.lineHeight;
            var usedWidth = line.width;
            var leftIndex = 0;
            var lineXLeft = xLeft;
            var lineXRight = xRight;
            var rightIndex = tokenCount - 1;
            var token = void 0;
            while (leftIndex < tokenCount
                && (token = tokens[leftIndex], !token.textAlign || token.textAlign === 'left')) {
                this._placeToken(token, style, lineHeight, lineTop, lineXLeft, 'left');
                usedWidth -= token.width;
                lineXLeft += token.width;
                leftIndex++;
            }
            while (rightIndex >= 0
                && (token = tokens[rightIndex], token.textAlign === 'right')) {
                this._placeToken(token, style, lineHeight, lineTop, lineXRight, 'right');
                usedWidth -= token.width;
                lineXRight -= token.width;
                rightIndex--;
            }
            lineXLeft += (contentWidth - (lineXLeft - xLeft) - (xRight - lineXRight) - usedWidth) / 2;
            while (leftIndex <= rightIndex) {
                token = tokens[leftIndex];
                this._placeToken(token, style, lineHeight, lineTop, lineXLeft + token.width / 2, 'center');
                lineXLeft += token.width;
                leftIndex++;
            }
            lineTop += lineHeight;
        }
    };
    RichText.prototype._placeToken = function (token, style, lineHeight, lineTop, x, textAlign) {
        var tokenStyle = style.rich[token.styleName] || {};
        tokenStyle.text = token.text;
        var textVerticalAlign = token.textVerticalAlign;
        var y = lineTop + lineHeight / 2;
        if (textVerticalAlign === 'top') {
            y = lineTop + token.height / 2;
        }
        else if (textVerticalAlign === 'bottom') {
            y = lineTop + lineHeight - token.height / 2;
        }
        !token.isLineHolder && needDrawBackground(tokenStyle) && this._renderBackground(tokenStyle, textAlign === 'right'
            ? x - token.width
            : textAlign === 'center'
                ? x - token.width / 2
                : x, y - token.height / 2, token.width, token.height);
        var textPadding = token.textPadding;
        if (textPadding) {
            x = getTextXForPadding(x, textAlign, textPadding);
            y -= token.height / 2 - textPadding[2] - token.textHeight / 2;
        }
        var el = new Text_1["default"]();
        var subElStyle = el.style;
        var hasStroke = 'textStroke' in tokenStyle || 'textStroke' in style;
        var hasFill = 'textFill' in tokenStyle || 'textFill' in style;
        var hasShadow = tokenStyle.textShadowBlur > 0
            || style.textShadowBlur > 0;
        subElStyle.text = token.text;
        subElStyle.x = x;
        subElStyle.y = y;
        if (hasShadow) {
            subElStyle.shadowBlur = tokenStyle.textShadowBlur || style.textShadowBlur || 0;
            subElStyle.shadowColor = tokenStyle.textShadowColor || style.textShadowColor || 'transparent';
            subElStyle.shadowOffsetX = tokenStyle.textShadowOffsetX || style.textShadowOffsetX || 0;
            subElStyle.shadowOffsetY = tokenStyle.textShadowOffsetY || style.textShadowOffsetY || 0;
        }
        subElStyle.textAlign = textAlign;
        subElStyle.textBaseline = 'middle';
        subElStyle.font = token.font || text_1.DEFAULT_FONT;
        if (hasStroke) {
            subElStyle.lineWidth = util_1.retrieve2(tokenStyle.textStrokeWidth, style.textStrokeWidth);
            subElStyle.stroke = getStroke(tokenStyle.textStroke || style.textStroke, subElStyle.lineWidth) || null;
        }
        if (hasFill) {
            subElStyle.fill = getFill(tokenStyle.textFill || style.textFill) || null;
        }
        this._addChild(el);
    };
    RichText.prototype._renderBackground = function (style, x, y, width, height) {
        var textBackgroundColor = style.textBackgroundColor;
        var textBorderWidth = style.textBorderWidth;
        var textBorderColor = style.textBorderColor;
        var isPlainBg = util_1.isString(textBackgroundColor);
        var textBorderRadius = style.textBorderRadius;
        var rectEl;
        var imgEl;
        if (isPlainBg || (textBorderWidth && textBorderColor)) {
            rectEl = new Rect_1["default"]();
            var rectShape = rectEl.shape;
            rectShape.x = x;
            rectShape.y = y;
            rectShape.width = width;
            rectShape.height = height;
            rectShape.r = textBorderRadius;
            this._addChild(rectEl);
        }
        if (isPlainBg) {
            var rectStyle = rectEl.style;
            rectStyle.fill = textBackgroundColor;
            rectStyle.opacity = util_1.retrieve2(style.opacity, 1);
            rectStyle.fillOpacity = util_1.retrieve2(style.fillOpacity, 1);
        }
        else if (textBackgroundColor && textBackgroundColor.image) {
            imgEl = new Image_1["default"]();
            var imgStyle = imgEl.style;
            imgStyle.image = textBackgroundColor.image;
            imgStyle.x = x;
            imgStyle.y = y;
            imgStyle.width = width;
            imgStyle.height = height;
            this._addChild(imgEl);
        }
        if (textBorderWidth && textBorderColor) {
            var rectStyle = rectEl.style;
            rectStyle.lineWidth = textBorderWidth;
            rectStyle.stroke = textBorderColor;
            rectStyle.strokeOpacity = util_1.retrieve2(style.strokeOpacity, 1);
        }
        var shadowStyle = (rectEl || imgEl).style;
        shadowStyle.shadowBlur = style.textBoxShadowBlur || 0;
        shadowStyle.shadowColor = style.textBoxShadowColor || 'transparent';
        shadowStyle.shadowOffsetX = style.textBoxShadowOffsetX || 0;
        shadowStyle.shadowOffsetY = style.textBoxShadowOffsetY || 0;
    };
    return RichText;
}(Element_1["default"]));
var VALID_TEXT_ALIGN = { left: true, right: 1, center: 1 };
var VALID_TEXT_VERTICAL_ALIGN = { top: 1, bottom: 1, middle: 1 };
function normalizeTextStyle(style) {
    normalizeStyle(style);
    util_1.each(style.rich, normalizeStyle);
    return style;
}
exports.normalizeTextStyle = normalizeTextStyle;
function normalizeStyle(style) {
    if (style) {
        style.font = makeFont(style);
        var textAlign = style.textAlign;
        textAlign === 'middle' && (textAlign = 'center');
        style.textAlign = (textAlign == null || VALID_TEXT_ALIGN[textAlign]) ? textAlign : 'left';
        var textVerticalAlign = style.textVerticalAlign;
        textVerticalAlign === 'center' && (textVerticalAlign = 'middle');
        style.textVerticalAlign = (textVerticalAlign == null || VALID_TEXT_VERTICAL_ALIGN[textVerticalAlign]) ? textVerticalAlign : 'top';
        var textPadding = style.textPadding;
        if (textPadding) {
            style.textPadding = util_1.normalizeCssArray(style.textPadding);
        }
    }
}
function getStroke(stroke, lineWidth) {
    return (stroke == null || lineWidth <= 0 || stroke === 'transparent' || stroke === 'none')
        ? null
        : (stroke.image || stroke.colorStops)
            ? '#000'
            : stroke;
}
function getFill(fill) {
    return (fill == null || fill === 'none')
        ? null
        : (fill.image || fill.colorStops)
            ? '#000'
            : fill;
}
function getTextXForPadding(x, textAlign, textPadding) {
    return textAlign === 'right'
        ? (x - textPadding[1])
        : textAlign === 'center'
            ? (x + textPadding[3] / 2 - textPadding[1] / 2)
            : (x + textPadding[3]);
}
function needDrawBackground(style) {
    return !!(style.textBackgroundColor
        || (style.textBorderWidth && style.textBorderColor));
}
function makeFont(style) {
    var font = (style.fontSize || style.fontFamily) && [
        style.fontStyle,
        style.fontWeight,
        (style.fontSize || 12) + 'px',
        style.fontFamily || 'sans-serif'
    ].join(' ');
    return font && util_1.trim(font) || style.textFont || style.font;
}
exports["default"] = RichText;
//# sourceMappingURL=RichText.js.map