import { Product } from "./product";

export interface DeliveryItem {
    ProductId: number;
    ProductName: string;
    ExternalReference: string;
    Quantity: number;
    UnitOfMeasure: string;
    Price: number;
    Deleted: boolean;
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
            ProductId: value && value.id || 0,
            ProductName: "",
            ExternalReference: "",
            Quantity: 0,
            UnitOfMeasure: "",
            Price: 0,
            Deleted: false,
        });
        this.element.value = this.ToJSON();
        return this.values.length - 1;
    }
    public UpdateRow(index: number, name: string, value: string): void {
        if (name == "product_names[]") {
            this.values[index].ProductName = value;
        }
        if (name == "external_references[]") {
            this.values[index].ExternalReference = value;
        }
        if (name == "quantities[]") {
            this.values[index].Quantity = Number(value);
        }
        if (name == "units_of_measure[]") {
            this.values[index].UnitOfMeasure = value;
        }
        if (name == "prices[]") {
            this.values[index].Price = Number(value);
        }
        this.element.value = this.ToJSON();
    }
    public RemoveRow(index: number): void {
        this.values[index].Deleted = true;
        this.element.value = this.ToJSON();
    }
}