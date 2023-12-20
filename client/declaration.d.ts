    // eslint-disable-next-line @typescript-eslint/no-namespace
declare namespace JSX {
    interface IntrinsicElements {
        div: any;
        input: any;
        span: any;
    }
}

declare module 'awesomplete';

declare class Awesomplete {
    constructor(input: HTMLInputElement, options?: any);
}
