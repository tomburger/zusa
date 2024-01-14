import { Product } from "./product";

// properties with PHP-friendly names
export interface DeliveryItem {
    product_id: number;
    product_name: string;
    external_reference: string;
    quantity: number;
    unit: string;
    price: number;
    deleted: boolean;
}

export class DeliveryItemsData {
    private values: DeliveryItem[] = [];
    constructor(
        private element: HTMLInputElement) 
    {
        this.values = element && element.value && JSON.parse(element.value) || [];
    }
    public GetValues(): DeliveryItem[] {
        return this.values;
    }
    public ToJSON(): string {
        return JSON.stringify(this.values);
    }
    public AddRow(value: Product | undefined): number {
        this.values.push({ 
            product_id: value && value.id || 0,
            product_name: "",
            external_reference: "",
            quantity: 0,
            unit: "",
            price: 0,
            deleted: false,
        });
        this.element.value = this.ToJSON();
        return this.values.length - 1;
    }
    public UpdateRow(index: number, name: string, value: string): void {
        if (name == "product_names[]") {
            this.values[index].product_name = value;
        }
        if (name == "external_references[]") {
            this.values[index].external_reference = value;
        }
        if (name == "quantities[]") {
            this.values[index].quantity = Number(value);
        }
        if (name == "units_of_measure[]") {
            this.values[index].unit = value;
        }
        if (name == "prices[]") {
            this.values[index].price = Number(value);
        }
        this.element.value = this.ToJSON();
    }
    public RemoveRow(index: number): void {
        this.values[index].deleted = true;
        this.element.value = this.ToJSON();
    }
}