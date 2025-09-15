// Escape HTML to prevent XSS attacks
export function escapeHtml(unsafe) {
    const unsafeTrim = String(unsafe || "").trim();
    return unsafeTrim
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
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
