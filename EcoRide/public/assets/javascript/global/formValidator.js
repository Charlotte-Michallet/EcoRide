// Escape HTML to prevent XSS attacks
export function escapeHtml(unsafe) {
    const unsafeTrim = String(unsafe || "").trim();
    return unsafeTrim
        .replaceAll(/&/g, "&amp;")
        .replaceAll(/</g, "&lt;")
        .replaceAll(/>/g, "&gt;")
        .replaceAll(/"/g, "&quot;")
        .replaceAll(/'/g, "&#039;");
}

// Display error message in a paragraph
export function errorDisplay(tag, message, valid) {
    const paragrapheError = document.getElementById(tag + "Error");
    if (!valid) {
        paragrapheError.classList.remove("hidden");
        paragrapheError.textContent = message;
    } else {
        paragrapheError.classList.add("hidden");
        paragrapheError.textContent = "";
    }
}

// Hide API city error message
export function apiCityFail(paragraphe) {
    paragraphe.classList.add("hidden");
    paragraphe.textContent = "";
}
