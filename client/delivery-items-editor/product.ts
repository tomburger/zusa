export class Product {
    constructor(
        public id: number, 
        public name: string, 
        public external_reference: string) {
    }
}


export function GetProductLabel(product: Product): string {
    return product.external_reference ? `${product.name} (${product.external_reference})` : product.name;
}
