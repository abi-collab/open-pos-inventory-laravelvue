"use strict";
exports.__esModule = true;
var tslib_1 = require("tslib");
var parseText_1 = require("./helper/parseText");
var Text_1 = require("./Text");
var util_1 = require("../core/util");
var text_1 = require("../contain/text");
var Image_1 = require("./Image");
var Rect_1 = require("./shape/Rect");
var BoundingRect_1 = require("../core/BoundingRect");
var Displayable_1 = require("./Displayable");
var DEFAULT_RICH_TEXT_COLOR = {
    fill: '#000'
};
var RichText = (function (_super) {
    tslib_1.__extends(RichText, _super);
    function RichText(opts) {
        var _this = _super.call(this) || this;
        _this.type = 'richtext';
        _this._children = [];
        _this._defaultColor = DEFAULT_RICH_TEXT_COLOR;
        _this.attr(opts);
        return _this;
    }
    RichText.prototype.childrenRef = function () {
        return this._children;
    };
    RichText.prototype.update = function () {
        if (this.__dirtyStyle) {
            this._updateSubTexts();
        }
        _super.prototype.update.call(this);
    };
    RichText.prototype._updateSubTexts = function () {
        this._childCursor = 0;
        normalizeTextStyle(this.style);
        this.style.rich
            ? this._updateRichTexts()
            : this._updatePlainTexts();
        this._children.length = this._childCursor;
        for (var i = 0; i < this._children.length; i++) {
            var child = this._children[i];
            child.zlevel = this.zlevel;
            child.z = this.z;
            child.z2 = this.z2;
            child.culling = this.culling;
            child.cursor = this.cursor;
            child.invisible = this.invisible;
        }
    };
    RichText.prototype.getBoundingRect = function () {
        if (this.__dirtyStyle) {
            this._updateSubTexts();
        }
        if (!this._rect) {
            var tmpRect = new BoundingRect_1["default"](0, 0, 0, 0);
            var children = this._children;
            var tmpMat = [];
            var rect = null;
            for (var i = 0; i < children.length; i++) {
                var child = children[i];
                var childRect = child.getBoundingRect();
                var transform = child.getLocalTransform(tmpMat);
                if (transform) {
                    tmpRect.copy(childRect);
                    tmpRect.applyTransform(transform);
                    rect = rect || tmpRect.clone();
                    rect.union(tmpRect);
                }
                else {
                    rect = rect || childRect.clone();
                    rect.union(childRect);
                }
            }
            this._rect = rect || tmpRect;
        }
        return this._rect;
    };
    RichText.prototype.setDefaultTextColor = function (defaultTextStyle) {
        this._defaultColor = defaultTextStyle || DEFAULT_RICH_TEXT_COLOR;
    };
    RichText.prototype.setTextContent = function (textContent) {
        throw new Error('Can\'t attach richText on another richText');
    };
    RichText.prototype._mergeStyle = function (targetStyle, sourceStyle) {
        var sourceRich = sourceStyle.rich;
        var targetRich = targetStyle.rich || (sourceRich && {});
        util_1.extend(targetStyle, sourceStyle);
        if (sourceRich && targetRich) {
            this._mergeRich(targetRich, sourceRich);
            targetStyle.rich = targetRich;
        }
        else if (targetRich) {
            targetStyle.rich = targetRich;
        }
        return targetStyle;
    };
    RichText.prototype._mergeRich = function (targetRich, sourceRich) {
        var richNames = util_1.keys(sourceRich);
        for (var i = 0; i < richNames.length; i++) {
            var richName = richNames[i];
            targetRich[richName] = targetRich[richName] || {};
            util_1.extend(targetRich[richName], sourceRich[richName]);
        }
    };
    RichText.prototype._getOrCreateChild = function (Ctor) {
        var child = this._children[this._childCursor];
        if (!child || !(child instanceof Ctor)) {
            child = new Ctor();
        }
        this._children[this._childCursor++] = child;
        child.parent = this;
        return child;
    };
    RichText.prototype._updatePlainTexts = function () {
        var style = this.style;
        var text = style.text || '';
        var textFont = style.font || text_1.DEFAULT_FONT;
        var textPadding = style.padding;
        var contentBlock = parseText_1.parsePlainText(text, style);
        var needDrawBg = needDrawBackground(style);
        var outerHeight = contentBlock.outerHeight;
        var textLines = contentBlock.lines;
        var lineHeight = contentBlock.lineHeight;
        var defaultColor = this._defaultColor;
        var baseX = style.x || 0;
        var baseY = style.y || 0;
        var textAlign = style.align || 'left';
        var textVerticalAlign = style.verticalAlign;
        var boxY = text_1.adjustTextY(baseY, outerHeight, textVerticalAlign);
        var textX = baseX;
        var textY = boxY;
        if (needDrawBg || textPadding) {
            var outerWidth_1 = contentBlock.width;
            textPadding && (outerWidth_1 += textPadding[1] + textPadding[3]);
            var boxX = text_1.adjustTextX(baseX, outerWidth_1, textAlign);
            needDrawBg && this._renderBackground(style, boxX, boxY, outerWidth_1, outerHeight);
            if (textPadding) {
                textX = getTextXForPadding(baseX, textAlign, textPadding);
                textY += textPadding[0];
            }
        }
        textY += lineHeight / 2;
        var textStrokeLineWidth = style.lineWidth;
        var textStroke = getStroke('stroke' in style ? style.stroke : defaultColor.stroke);
        var textFill = getFill('fill' in style ? style.fill : defaultColor.fill);
        var hasShadow = style.textShadowBlur > 0;
        for (var i = 0; i < textLines.length; i++) {
            var el = this._getOrCreateChild(Text_1["default"]);
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
            if (textStroke) {
                subElStyle.stroke = textStroke;
                subElStyle.lineWidth = textStrokeLineWidth || defaultColor.lineWidth;
            }
            if (textFill) {
                subElStyle.fill = textFill;
            }
            subElStyle.font = textFont;
            textY += lineHeight;
        }
    };
    RichText.prototype._updateRichTexts = function () {
        var style = this.style;
        var contentBlock = parseText_1.parseRichText(style.text || '', style);
        var contentWidth = contentBlock.width;
        var outerWidth = contentBlock.outerWidth;
        var outerHeight = contentBlock.outerHeight;
        var textPadding = style.padding;
        var baseX = style.x || 0;
        var baseY = style.y || 0;
        var textAlign = style.align;
        var textVerticalAlign = style.verticalAlign;
        var boxX = text_1.adjustTextX(baseX, outerWidth, textAlign);
        var boxY = text_1.adjustTextY(baseY, outerHeight, textVerticalAlign);
        var xLeft = boxX;
        var lineTop = boxY;
        if (textPadding) {
            xLeft += textPadding[3];
            lineTop += textPadding[0];
        }
        var xRight = xLeft + contentWidth;
        if (needDrawBackground(style)) {
            this._renderBackground(style, boxX, boxY, outerWidth, outerHeight);
        }
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
            y -= token.height / 2 - textPadding[2] - token.height / 2;
        }
        var el = this._getOrCreateChild(Text_1["default"]);
        var subElStyle = el.style;
        var defaultColor = this._defaultColor;
        var textStroke = getStroke('stroke' in tokenStyle ? tokenStyle.stroke
            : 'stroke' in style ? style.stroke : defaultColor.stroke);
        var textFill = getStroke('fill' in tokenStyle ? tokenStyle.fill
            : 'fill' in style ? style.fill : defaultColor.fill);
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
        if (textStroke) {
            subElStyle.lineWidth = util_1.retrieve3(tokenStyle.lineWidth, style.lineWidth, defaultColor.lineWidth);
            subElStyle.stroke = textStroke;
        }
        if (textFill) {
            subElStyle.fill = textFill;
        }
    };
    RichText.prototype._renderBackground = function (style, x, y, width, height) {
        var textBackgroundColor = style.backgroundColor;
        var textBorderWidth = style.borderWidth;
        var textBorderColor = style.borderColor;
        var isPlainBg = util_1.isString(textBackgroundColor);
        var textBorderRadius = style.borderRadius;
        var self = this;
        var rectEl;
        var imgEl;
        if (isPlainBg || (textBorderWidth && textBorderColor)) {
            rectEl = this._getOrCreateChild(Rect_1["default"]);
            rectEl.style.fill = null;
            var rectShape = rectEl.shape;
            rectShape.x = x;
            rectShape.y = y;
            rectShape.width = width;
            rectShape.height = height;
            rectShape.r = textBorderRadius;
            rectEl.dirtyShape();
        }
        if (isPlainBg) {
            var rectStyle = rectEl.style;
            rectStyle.fill = textBackgroundColor || null;
            rectStyle.opacity = util_1.retrieve2(style.opacity, 1);
            rectStyle.fillOpacity = util_1.retrieve2(style.fillOpacity, 1);
        }
        else if (textBackgroundColor && textBackgroundColor.image) {
            imgEl = this._getOrCreateChild(Image_1["default"]);
            imgEl.onload = function () {
                self.dirtyStyle();
            };
            var imgStyle = imgEl.style;
            imgStyle.image = textBackgroundColor.image;
            imgStyle.x = x;
            imgStyle.y = y;
            imgStyle.width = width;
            imgStyle.height = height;
        }
        if (textBorderWidth && textBorderColor) {
            var rectStyle = rectEl.style;
            rectStyle.lineWidth = textBorderWidth;
            rectStyle.stroke = textBorderColor;
            rectStyle.strokeOpacity = util_1.retrieve2(style.strokeOpacity, 1);
        }
        var shadowStyle = (rectEl || imgEl).style;
        shadowStyle.shadowBlur = style.shadowBlur || 0;
        shadowStyle.shadowColor = style.shadowColor || 'transparent';
        shadowStyle.shadowOffsetX = style.shadowOffsetX || 0;
        shadowStyle.shadowOffsetY = style.shadowOffsetY || 0;
    };
    RichText.makeFont = function (style) {
        var font = (style.fontSize || style.fontFamily) && [
            style.fontStyle,
            style.fontWeight,
            (style.fontSize || 12) + 'px',
            style.fontFamily || 'sans-serif'
        ].join(' ');
        return font && util_1.trim(font) || style.textFont || style.font;
    };
    return RichText;
}(Displayable_1["default"]));
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
        style.font = RichText.makeFont(style);
        var textAlign = style.align;
        textAlign === 'middle' && (textAlign = 'center');
        style.align = (textAlign == null || VALID_TEXT_ALIGN[textAlign]) ? textAlign : 'left';
        var textVerticalAlign = style.verticalAlign;
        textVerticalAlign === 'center' && (textVerticalAlign = 'middle');
        style.verticalAlign = (textVerticalAlign == null || VALID_TEXT_VERTICAL_ALIGN[textVerticalAlign]) ? textVerticalAlign : 'top';
        var textPadding = style.padding;
        if (textPadding) {
            style.padding = util_1.normalizeCssArray(style.padding);
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
    return !!(style.backgroundColor
        || (style.borderWidth && style.borderColor));
}
exports["default"] = RichText;
//# sourceMappingURL=RichText.js.map