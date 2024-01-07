    // eslint-disable-next-line @typescript-eslint/no-namespace
declare namespace JSX {
    interface IntrinsicElements {
        [elementName: string]: any;
    }
}

declare module 'awesomplete';

declare class Awesomplete {
    constructor(input: HTMLInputElement, options?: any);
    static FILTER_CONTAINS(input: any, text: string): boolean;
}
