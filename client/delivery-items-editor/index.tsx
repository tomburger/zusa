import { RenderElement } from "../render";
import "awesomplete";

class DeliveryItemsEditor {
    constructor(private element: HTMLElement) {
        // constructor implementation
    }
    Bind() {
        this.Render();
        this.BindAutocomplete();
    }
    private Render() {
        const content = <div class="delivery-items-editor">
            <div class="product-rows">
            </div>
            <div class="new-product">
                <input type="text" class="form-control" id="deliveryItems" name="deliveryItems" placeholder="Select product..." />
            </div>
        </div>
        this.element.innerHTML = content;
    }
    private BindAutocomplete() {
        const products = document.getElementById("product-list");
        if (products) {
            const list = JSON.parse(products.innerText);
            const input = this.element.querySelector("#deliveryItems") as HTMLInputElement;
            const autocomplete = new Awesomplete(input, {
                list: list,
            });
            input.addEventListener("awesomplete-selectcomplete", (event: any) => {
                this.RenderProductRow(event.text);
                input.value = "";
            });
        }
    }
    private RenderProductRow(product: { id: string, label: string }) {
        const row = <div class="product-row row">
            <input type="hidden" name="products[]" value={product.id} />
            <div class="col product-name">{product.label}</div>
            <div class="col">
                <input type="number" class="form-control" name="quantities[]" value="1" />
            </div>
        </div>
        const rows = this.element.querySelector(".product-rows") as HTMLElement;
        rows.insertAdjacentHTML('beforeend', row);
    }
}

export function BindDeliveryItemsEditor(element: HTMLElement) {
    const editor = new DeliveryItemsEditor(element);
    editor.Bind();
}