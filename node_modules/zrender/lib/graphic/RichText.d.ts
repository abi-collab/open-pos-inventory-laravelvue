import { TextAlign, TextVerticalAlign, ImageLike, Dictionary } from '../core/types';
import ZRText from './Text';
import ZRImage from './Image';
import Rect from './shape/Rect';
import BoundingRect from '../core/BoundingRect';
import Displayable, { DisplayableStatePropNames, DisplayableProps } from './Displayable';
interface RichTextStylePropsPart {
    text?: string;
    fill?: string;
    stroke?: string;
    opacity?: number;
    fillOpacity?: number;
    strokeOpacity?: number;
    lineWidth?: number;
    font?: string;
    textFont?: string;
    fontStyle?: 'normal' | 'italic' | 'oblique';
    fontWeight?: 'normal' | 'bold' | 'bolder' | 'lighter' | number;
    fontFamily?: string;
    fontSize?: number;
    align?: TextAlign;
    verticalAlign?: TextVerticalAlign;
    lineHeight?: number;
    width?: number | string;
    height?: number;
    tag?: string;
    textShadowColor?: string;
    textShadowBlur?: number;
    textShadowOffsetX?: number;
    textShadowOffsetY?: number;
    backgroundColor?: string | {
        image: ImageLike | string;
    };
    padding?: number | number[];
    borderColor?: string;
    borderWidth?: number;
    borderRadius?: number | number[];
    shadowColor?: string;
    shadowBlur?: number;
    shadowOffsetX?: number;
    shadowOffsetY?: number;
}
export interface RichTextStyleProps extends RichTextStylePropsPart {
    text?: string;
    x?: number;
    y?: number;
    width?: number;
    rich?: Dictionary<RichTextStylePropsPart>;
    overflow?: 'wrap' | 'truncate';
    lineOverflow?: 'truncate';
    ellipsis?: string;
    placeholder?: string;
    truncateMinChar?: number;
}
export interface RichTextProps extends DisplayableProps {
    style?: RichTextStyleProps;
    zlevel?: number;
    z?: number;
    z2?: number;
    culling?: boolean;
    cursor?: string;
}
export declare type RichTextState = Pick<RichTextProps, DisplayableStatePropNames>;
declare class RichText extends Displayable<RichTextProps> {
    type: string;
    style: RichTextStyleProps;
    private _children;
    private _childCursor;
    private _defaultColor;
    constructor(opts?: RichTextProps);
    childrenRef(): (ZRText | ZRImage | Rect)[];
    update(): void;
    private _updateSubTexts;
    getBoundingRect(): BoundingRect;
    setDefaultTextColor(defaultTextStyle: Pick<RichTextStyleProps, 'fill' | 'stroke' | 'lineWidth'>): void;
    setTextContent(textContent: never): void;
    protected _mergeStyle(targetStyle: RichTextStyleProps, sourceStyle: RichTextStyleProps): RichTextStyleProps;
    private _mergeRich;
    private _getOrCreateChild;
    private _updatePlainTexts;
    private _updateRichTexts;
    private _placeToken;
    private _renderBackground;
    static makeFont(style: RichTextStylePropsPart): string;
}
export declare function normalizeTextStyle(style: RichTextStyleProps): RichTextStyleProps;
export default RichText;
