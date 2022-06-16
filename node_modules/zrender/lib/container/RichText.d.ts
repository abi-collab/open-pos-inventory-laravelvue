import { PatternObject } from '../graphic/Pattern';
import { LinearGradientObject } from '../graphic/LinearGradient';
import { RadialGradientObject } from '../graphic/RadialGradient';
import { TextAlign, TextVerticalAlign, ImageLike, Dictionary, AllPropTypes } from '../core/types';
import Element, { ElementOption } from '../Element';
interface RichTextStyleOptionPart {
    text?: string;
    textFill?: string | PatternObject | LinearGradientObject | RadialGradientObject;
    textStroke?: string | PatternObject | LinearGradientObject | RadialGradientObject;
    opacity?: number;
    fillOpacity?: number;
    strokeOpacity?: number;
    textStrokeWidth?: number;
    font?: string;
    textFont?: string;
    fontStyle?: string;
    fontWeight?: string;
    fontFamily?: string;
    fontSize?: number;
    textAlign?: TextAlign;
    textVerticalAlign?: TextVerticalAlign;
    textLineHeight?: number;
    textWidth?: number | string;
    textHeight?: number;
    textTag?: string;
    textShadowColor?: string;
    textShadowBlur?: number;
    textShadowOffsetX?: number;
    textShadowOffsetY?: number;
    textBackgroundColor?: string | {
        image: ImageLike | string;
    };
    textPadding?: number | number[];
    textBorderColor?: string;
    textBorderWidth?: number;
    textBorderRadius?: number | number[];
    textBoxShadowColor?: string;
    textBoxShadowBlur?: number;
    textBoxShadowOffsetX?: number;
    textBoxShadowOffsetY?: number;
}
export interface RichTextStyleOption extends RichTextStyleOptionPart {
    text?: string;
    x?: number;
    y?: number;
    wrap?: false;
    rich?: Dictionary<RichTextStyleOptionPart>;
    truncate?: {
        outerWidth?: number;
        outerHeight?: number;
        ellipsis?: string;
        placeholder?: string;
        minChar?: number;
    };
}
interface RichTextOption extends ElementOption {
    style?: RichTextStyleOption;
}
interface RichText {
    attr(key: RichTextOption): RichText;
    attr(key: keyof RichTextOption, value: AllPropTypes<RichTextOption>): RichText;
}
declare class RichText extends Element {
    readonly isGroup = true;
    style?: RichTextStyleOption;
    private _children;
    private _styleChanged;
    constructor(opts?: RichTextOption);
    update(): void;
    attrKV(key: keyof RichTextOption, value: AllPropTypes<RichTextStyleOption>): void;
    setStyle(obj: RichTextStyleOption): void;
    setStyle(obj: keyof RichTextStyleOption, value: any): void;
    dirtyStyle(): void;
    children(): Element[];
    private _addChild;
    private _updatePlainTexts;
    private _updateRichTexts;
    private _placeToken;
    private _renderBackground;
}
export declare function normalizeTextStyle(style: RichTextStyleOption): RichTextStyleOption;
export default RichText;
