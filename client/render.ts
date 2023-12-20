export function RenderElement(element: string, properties: { [name: string] : string; }, ...children: string[]): string {
    let result = "<" + element;
    for (let name in properties) {
        const value = properties[name];
        if (typeof(value) == "boolean") {
            if (value) result += " " + name;
        }
        else {
            result += " " + name + "='" + value + "'";
        }
    }
    result += ">";
    result += children.join(""); 
    result += "</" + element + ">";
    return result;
}
export function RenderIf(condition: boolean, trueElement: string, falseElement: string = "") {
    return condition ? trueElement : falseElement;
}
export function RenderTimes(count: number, element: (ix: number) => string) {
    const result: string[] = [];
    for (let ix = 0; ix < count; ix++) {
        result.push(element(ix));
    }
    return result.join("");
}