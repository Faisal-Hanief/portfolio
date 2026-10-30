// Small helper for calling our own Laravel API.
export async function getJson(path) {
    const response = await fetch("/api" + path, {
        headers: { Accept: "application/json" },
    });

    if (!response.ok) {
        throw new Error("Request failed with status " + response.status);
    }

    const json = await response.json();

    return json.data;
}
