import { BindDeliveryItemsEditor } from "./delivery-items-editor";

export function Main() {
    const deliveryItemsEditorElement = document.getElementById('delivery-items-editor');
    if (deliveryItemsEditorElement) {
        BindDeliveryItemsEditor(deliveryItemsEditorElement);
    }
}