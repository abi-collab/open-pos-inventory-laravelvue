import { PropType, TextAlign, TextVerticalAlign } from '../../core/types';
import { RichTextStyleOption } from '../RichText';
interface InnerTruncateOption {
    maxIteration?: number;
    minChar?: number;
    placeholder?: string;
    maxIterations?: number;
}
export declare function truncateText(text: string, containerWidth: number, font: string, ellipsis: string, options: InnerTruncateOption): string;
export interface PlainTextContentBlock {
    lineHeight: number;
    height: number;
    outerHeight: number;
    canCacheByTextString: boolean;
    lines: string[];
}
export declare function parsePlainText(text: string, font: string, padding: number[], textLineHeight: number, truncate: PropType<RichTextStyleOption, 'truncate'>): PlainTextContentBlock;
declare class RichTextToken {
    styleName: string;
    text: string;
    width: number;
    height: number;
    textWidth: number | string;
    textHeight: number;
    lineHeight: number;
    font: string;
    textAlign: TextAlign;
    textVerticalAlign: TextVerticalAlign;
    textPadding: number[];
    percentWidth?: string;
    isLineHolder: boolean;
}
declare class RichTextLine {
    lineHeight: number;
    width: number;
    tokens: RichTextToken[];
    constructor(tokens?: RichTextToken[]);
}
export declare class RichTextContentBlock {
    width: number;
    height: number;
    outerWidth: number;
    outerHeight: number;
    lines: RichTextLine[];
}
export declare function parseRichText(text: string, style: RichTextStyleOption): RichTextContentBlock;
export {};
