"use strict";
exports.__esModule = true;
var imageHelper = require("../../graphic/helper/image");
var util_1 = require("../../core/util");
var text_1 = require("../../contain/text");
var STYLE_REG = /\{([a-zA-Z0-9_]+)\|([^}]*)\}/g;
function truncateText(text, containerWidth, font, ellipsis, options) {
    if (!containerWidth) {
        return '';
    }
    var textLines = (text + '').split('\n');
    options = prepareTruncateOptions(containerWidth, font, ellipsis, options);
    for (var i = 0, len = textLines.length; i < len; i++) {
        textLines[i] = truncateSingleLine(textLines[i], options);
    }
    return textLines.join('\n');
}
exports.truncateText = truncateText;
function prepareTruncateOptions(containerWidth, font, ellipsis, options) {
    options = options || {};
    var preparedOpts = util_1.extend({}, options);
    preparedOpts.font = font;
    ellipsis = util_1.retrieve2(ellipsis, '...');
    preparedOpts.maxIterations = util_1.retrieve2(options.maxIterations, 2);
    var minChar = preparedOpts.minChar = util_1.retrieve2(options.minChar, 0);
    preparedOpts.cnCharWidth = text_1.getWidth('国', font);
    var ascCharWidth = preparedOpts.ascCharWidth = text_1.getWidth('a', font);
    preparedOpts.placeholder = util_1.retrieve2(options.placeholder, '');
    var contentWidth = containerWidth = Math.max(0, containerWidth - 1);
    for (var i = 0; i < minChar && contentWidth >= ascCharWidth; i++) {
        contentWidth -= ascCharWidth;
    }
    var ellipsisWidth = text_1.getWidth(ellipsis, font);
    if (ellipsisWidth > contentWidth) {
        ellipsis = '';
        ellipsisWidth = 0;
    }
    contentWidth = containerWidth - ellipsisWidth;
    preparedOpts.ellipsis = ellipsis;
    preparedOpts.ellipsisWidth = ellipsisWidth;
    preparedOpts.contentWidth = contentWidth;
    preparedOpts.containerWidth = containerWidth;
    return preparedOpts;
}
function truncateSingleLine(textLine, options) {
    var containerWidth = options.containerWidth;
    var font = options.font;
    var contentWidth = options.contentWidth;
    if (!containerWidth) {
        return '';
    }
    var lineWidth = text_1.getWidth(textLine, font);
    if (lineWidth <= containerWidth) {
        return textLine;
    }
    for (var j = 0;; j++) {
        if (lineWidth <= contentWidth || j >= options.maxIterations) {
            textLine += options.ellipsis;
            break;
        }
        var subLength = j === 0
            ? estimateLength(textLine, contentWidth, options.ascCharWidth, options.cnCharWidth)
            : lineWidth > 0
                ? Math.floor(textLine.length * contentWidth / lineWidth)
                : 0;
        textLine = textLine.substr(0, subLength);
        lineWidth = text_1.getWidth(textLine, font);
    }
    if (textLine === '') {
        textLine = options.placeholder;
    }
    return textLine;
}
function estimateLength(text, contentWidth, ascCharWidth, cnCharWidth) {
    var width = 0;
    var i = 0;
    for (var len = text.length; i < len && width < contentWidth; i++) {
        var charCode = text.charCodeAt(i);
        width += (0 <= charCode && charCode <= 127) ? ascCharWidth : cnCharWidth;
    }
    return i;
}
function parsePlainText(text, font, padding, textLineHeight, truncate) {
    text != null && (text += '');
    var lineHeight = util_1.retrieve2(textLineHeight, text_1.getLineHeight(font));
    var lines = text ? text.split('\n') : [];
    var height = lines.length * lineHeight;
    var outerHeight = height;
    var canCacheByTextString = true;
    if (padding) {
        outerHeight += padding[0] + padding[2];
    }
    if (text && truncate) {
        canCacheByTextString = false;
        var truncOuterHeight = truncate.outerHeight;
        var truncOuterWidth = truncate.outerWidth;
        if (truncOuterHeight != null && outerHeight > truncOuterHeight) {
            text = '';
            lines = [];
        }
        else if (truncOuterWidth != null) {
            var options = prepareTruncateOptions(truncOuterWidth - (padding ? padding[1] + padding[3] : 0), font, truncate.ellipsis, {
                minChar: truncate.minChar,
                placeholder: truncate.placeholder
            });
            for (var i = 0, len = lines.length; i < len; i++) {
                lines[i] = truncateSingleLine(lines[i], options);
            }
        }
    }
    return {
        lines: lines,
        height: height,
        outerHeight: outerHeight,
        lineHeight: lineHeight,
        canCacheByTextString: canCacheByTextString
    };
}
exports.parsePlainText = parsePlainText;
var RichTextToken = (function () {
    function RichTextToken() {
    }
    return RichTextToken;
}());
var RichTextLine = (function () {
    function RichTextLine(tokens) {
        this.tokens = [];
        if (tokens) {
            this.tokens = tokens;
        }
    }
    return RichTextLine;
}());
var RichTextContentBlock = (function () {
    function RichTextContentBlock() {
        this.width = 0;
        this.height = 0;
        this.outerWidth = 0;
        this.outerHeight = 0;
        this.lines = [];
    }
    return RichTextContentBlock;
}());
exports.RichTextContentBlock = RichTextContentBlock;
function parseRichText(text, style) {
    var contentBlock = new RichTextContentBlock();
    text != null && (text += '');
    if (!text) {
        return contentBlock;
    }
    var lastIndex = STYLE_REG.lastIndex = 0;
    var result;
    while ((result = STYLE_REG.exec(text)) != null) {
        var matchedIndex = result.index;
        if (matchedIndex > lastIndex) {
            pushTokens(contentBlock, text.substring(lastIndex, matchedIndex));
        }
        pushTokens(contentBlock, result[2], result[1]);
        lastIndex = STYLE_REG.lastIndex;
    }
    if (lastIndex < text.length) {
        pushTokens(contentBlock, text.substring(lastIndex, text.length));
    }
    var lines = contentBlock.lines;
    var contentHeight = 0;
    var contentWidth = 0;
    var pendingList = [];
    var stlPadding = style.textPadding;
    var truncate = style.truncate;
    var truncateWidth = truncate && truncate.outerWidth;
    var truncateHeight = truncate && truncate.outerHeight;
    if (stlPadding) {
        truncateWidth != null && (truncateWidth -= stlPadding[1] + stlPadding[3]);
        truncateHeight != null && (truncateHeight -= stlPadding[0] + stlPadding[2]);
    }
    for (var i = 0; i < lines.length; i++) {
        var line = lines[i];
        var lineHeight = 0;
        var lineWidth = 0;
        for (var j = 0; j < line.tokens.length; j++) {
            var token = line.tokens[j];
            var tokenStyle = token.styleName && style.rich[token.styleName] || {};
            var textPadding = token.textPadding = tokenStyle.textPadding;
            var font = token.font = tokenStyle.font || style.font;
            var tokenHeight = token.textHeight = util_1.retrieve2(tokenStyle.textHeight, text_1.getLineHeight(font));
            textPadding && (tokenHeight += textPadding[0] + textPadding[2]);
            token.height = tokenHeight;
            token.lineHeight = util_1.retrieve3(tokenStyle.textLineHeight, style.textLineHeight, tokenHeight);
            token.textAlign = tokenStyle && tokenStyle.textAlign || style.textAlign;
            token.textVerticalAlign = tokenStyle && tokenStyle.textVerticalAlign || 'middle';
            if (truncateHeight != null && contentHeight + token.lineHeight > truncateHeight) {
                return new RichTextContentBlock();
            }
            token.textWidth = text_1.getWidth(token.text, font);
            var tokenWidth = tokenStyle.textWidth;
            var tokenWidthNotSpecified = tokenWidth == null || tokenWidth === 'auto';
            if (typeof tokenWidth === 'string' && tokenWidth.charAt(tokenWidth.length - 1) === '%') {
                token.percentWidth = tokenWidth;
                pendingList.push(token);
                tokenWidth = 0;
            }
            else {
                if (tokenWidthNotSpecified) {
                    tokenWidth = token.textWidth;
                    var textBackgroundColor = tokenStyle.textBackgroundColor;
                    var bgImg = textBackgroundColor && textBackgroundColor.image;
                    if (bgImg) {
                        bgImg = imageHelper.findExistImage(bgImg);
                        if (imageHelper.isImageReady(bgImg)) {
                            tokenWidth = Math.max(tokenWidth, bgImg.width * tokenHeight / bgImg.height);
                        }
                    }
                }
                var paddingW = textPadding ? textPadding[1] + textPadding[3] : 0;
                tokenWidth += paddingW;
                var remianTruncWidth = truncateWidth != null ? truncateWidth - lineWidth : null;
                if (remianTruncWidth != null && remianTruncWidth < tokenWidth) {
                    if (!tokenWidthNotSpecified || remianTruncWidth < paddingW) {
                        token.text = '';
                        token.textWidth = tokenWidth = 0;
                    }
                    else {
                        token.text = truncateText(token.text, remianTruncWidth - paddingW, font, truncate.ellipsis, { minChar: truncate.minChar });
                        token.textWidth = text_1.getWidth(token.text, font);
                        tokenWidth = token.textWidth + paddingW;
                    }
                }
            }
            lineWidth += (token.width = tokenWidth);
            tokenStyle && (lineHeight = Math.max(lineHeight, token.lineHeight));
        }
        line.width = lineWidth;
        line.lineHeight = lineHeight;
        contentHeight += lineHeight;
        contentWidth = Math.max(contentWidth, lineWidth);
    }
    contentBlock.outerWidth = contentBlock.width = util_1.retrieve2(style.textWidth, contentWidth);
    contentBlock.outerHeight = contentBlock.height = util_1.retrieve2(style.textHeight, contentHeight);
    if (stlPadding) {
        contentBlock.outerWidth += stlPadding[1] + stlPadding[3];
        contentBlock.outerHeight += stlPadding[0] + stlPadding[2];
    }
    for (var i = 0; i < pendingList.length; i++) {
        var token = pendingList[i];
        var percentWidth = token.percentWidth;
        token.width = parseInt(percentWidth, 10) / 100 * contentWidth;
    }
    return contentBlock;
}
exports.parseRichText = parseRichText;
function pushTokens(block, str, styleName) {
    var isEmptyStr = str === '';
    var strs = str.split('\n');
    var lines = block.lines;
    for (var i = 0; i < strs.length; i++) {
        var text = strs[i];
        var token = new RichTextToken();
        token.styleName = styleName;
        token.text = text;
        token.isLineHolder = !text && !isEmptyStr;
        if (!i) {
            var tokens = (lines[lines.length - 1] || (lines[0] = new RichTextLine())).tokens;
            var tokensLen = tokens.length;
            (tokensLen === 1 && tokens[0].isLineHolder)
                ? (tokens[0] = token)
                : ((text || !tokensLen || isEmptyStr) && tokens.push(token));
        }
        else {
            lines.push(new RichTextLine([token]));
        }
    }
}
//# sourceMappingURL=parse.js.map