import { toggleDeleteModal } from "./scripts/deleteModalScript";
import { toggleEditModal } from "./scripts/editModalScript";

export default function extractForumIdFromUrl (): string {
    const pathname: string = window.location.pathname;
    return pathname.split('/')[2];
}

export function extractThreadIdFromUrl (): string {
    const pathname: string = window.location.pathname;
    return pathname.split('/')[3];
}

export function extractPostIdFromUrl (): string {
    const pathname: string = window.location.pathname;
    return pathname.split('/')[4];
}

export function reAttachEventListeners (): void {
    const deleteButtons = document.querySelectorAll(".delete-element-button");
        deleteButtons.forEach((deleteButton: HTMLButtonElement) => deleteButton && deleteButton.addEventListener("click", toggleDeleteModal));
    const editButtons = document.querySelectorAll(".edit-element-button");
    editButtons.forEach((editButton: HTMLButtonElement) => editButton && editButton.addEventListener("click", toggleEditModal));
}