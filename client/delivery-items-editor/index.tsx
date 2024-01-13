import { RenderElement } from "../render";
import "awesomplete";
import { GetProductLabel, Product } from "./product";
import { DeliveryItemsData } from "./data";

class DeliveryItemsEditor {
    private counter: number = 0;
    private products: Product[] = [];
    private usedProducts: number[] = [];
    private data: DeliveryItemsData;
    constructor(private element: HTMLElement) {
        const productList = document.getElementById("product-list");
        this.products = productList && JSON.parse(productList.innerText) || [];
        const dataElement = document.getElementById("delivery_items") as HTMLInputElement;
        this.data = new DeliveryItemsData(dataElement);
    }
    Bind() {
        this.Render();
        this.BindControls();
    }
    private Render() {
        const content = <div class="delivery-items-editor">
            <div class="row mb-3">
                <h3>Delivery Items</h3>
            </div>
            <div class="product-rows"></div>
            <div class="new-product row">
                <div class="col-1">
                    <label class="form-label me-2" for="selectedProduct">Product</label>
                </div>
                <div class="col">
                    <input type="text" class="form-control" id="selectedProduct" name="selectedProduct" placeholder="Select product..." />
                    <span class="ms-2 me-2">or</span>
                    <span>
                        <a href="#" id="addNewProduct" class="btn btn-primary">Create new</a>
                    </span>
                </div>
            </div>
        </div>
        this.element.innerHTML = content;
    }
    private BindControls() {
        const input = this.element.querySelector("#selectedProduct") as HTMLInputElement;
        const autocomplete = new Awesomplete(input, {
            list: this.products,
            data: (item: Product) => [GetProductLabel(item), item.id],
            filter: (item: any, text: string) => this.usedProducts.indexOf(item.value) < 0 && Awesomplete.FILTER_CONTAINS(item, text),
        });
        input.addEventListener("awesomplete-selectcomplete", (event: any) => {
            this.usedProducts.push(event.text.value);
            const product = this.products.find(p => p.id == event.text.value);
            const index = this.data.AddRow(product)
            this.RenderProductRow(index, product);
            input.value = "";
        });
        const button = document.getElementById("addNewProduct");
        if (button) {
            button.addEventListener("click", (event) => {
                event.preventDefault();
                const index = this.data.AddRow(undefined);
                this.RenderProductRow(index);
            });
        }
    }
    private RenderProductRow(index: number, product: Product | undefined = undefined) {
        this.counter++;
        const row = <div class="product-row row mb-3" data-counter={this.counter} data-index={index}>
            <div class="col-1">{this.counter}</div>
            {product 
                ? <div class="col-3"><input type="text" class="form-control" name="product_names[]" disabled
                            value={`${product.name} (${product.id})`} /></div>
                : <div class="col-3"><input type="text" class="form-control" name="product_names[]" value="" placeholder="Product name" /></div>}
            {product 
                ? <div class="col-1"><input type="text" class="form-control" name="external_references[]" disabled value={product.external_reference} /></div>
                : <div class="col-1"><input type="text" class="form-control" name="external_references[]" value="" placeholder="External Reference" /></div>}
            <div class="col">
                <input type="number" class="form-control" name="quantities[]" value="" placeholder="Quantity" />
            </div>
            <div class="col">
                <input type="text" class="form-control" name="units_of_measure[]" value="" placeholder="Unit" />
            </div>
            <div class="col">
                <input type="number" class="form-control" name="prices[]" value="" placeholder="Price" />
            </div>
            <div class="col">
                <a class="btn btn-secondary delete-button" href="#"><i class="bi bi-trash"></i></a>
            </div>
        </div>
        const rows = this.element.querySelector(".product-rows") as HTMLElement;
        rows.insertAdjacentHTML('beforeend', row);

        const rowElement = rows.querySelector(`[data-counter="${this.counter}"]`) as HTMLElement;

        const deleteButton = rowElement.querySelector(".delete-button") as HTMLElement;
        deleteButton.addEventListener("click", (event) => {
            event.preventDefault();
            if (product && product.id) { 
                const index = this.usedProducts.indexOf(product.id);
                if (index >= 0) {
                    this.usedProducts.splice(index, 1);
                }
            }
            this.data.RemoveRow(index);
            rowElement.remove();
        });

        rowElement.querySelectorAll("input").forEach(el => {
            el.addEventListener("change", (event) => {
                const input = event.target as HTMLInputElement;
                this.data.UpdateRow(index, input.name, input.value);
            });
        });

        const input = product 
                        ? rowElement.querySelector("input[name='quantities[]']") as HTMLInputElement
                        : rowElement.querySelector("input[name='product_names[]']") as HTMLInputElement;
        input.focus();
    }
}

export function BindDeliveryItemsEditor(element: HTMLElement) {
    const editor = new DeliveryItemsEditor(element);
    editor.Bind();
}