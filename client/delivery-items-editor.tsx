import { RenderElement } from "./render";
import "awesomplete";

class DeliveryItemsEditor {
    constructor(private element: HTMLElement) {
        // constructor implementation
    }
    Bind() {
        this.element.innerHTML = <div>
            <input type="text" class="form-control" id="deliveryItems" name="deliveryItems" placeholder="Select product..." />
            <span class="itemLabel"></span>
        </div>;
        const products = document.getElementById("product-list");
        if (products) {
            const list = JSON.parse(products.innerText);
            const input = this.element.querySelector("#deliveryItems") as HTMLInputElement;
            const autocomplete = new Awesomplete(input, { 
                list: list,
            });
            input.addEventListener("awesomplete-selectcomplete", (event: any) => {
                const labelSpan = this.element.closest("div")?.querySelector(".itemLabel");
                if (labelSpan) labelSpan.innerHTML = event.text.label;
            });
        }
    }
}

export function BindDeliveryItemsEditor(element: HTMLElement) {
    const editor = new DeliveryItemsEditor(element);
    editor.Bind();
}