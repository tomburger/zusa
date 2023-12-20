import { RenderElement } from "./render";

class DeliveryItemsEditor {
    constructor(private element: HTMLElement) {
        // constructor implementation
    }
    Bind() {
       this.element.innerHTML = <div>Here comes the editor!</div>;
    }
}

export function BindDeliveryItemsEditor(element: HTMLElement) {
    const editor = new DeliveryItemsEditor(element);
    editor.Bind();
}