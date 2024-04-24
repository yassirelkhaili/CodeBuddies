/**
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/

import postService from "../services/postService";

const openButton = document.querySelectorAll(
    ".edit-post-model-button"
) as NodeListOf<HTMLButtonElement>;
const cancelButton = document.querySelectorAll(
    ".cancel-edit-post-modal-element"
) as NodeListOf<HTMLButtonElement>;
const editModal = document.querySelectorAll(
    ".edit-post-form"
) as NodeListOf<HTMLFormElement>;
const actionButtons: Array<HTMLButtonElement> = [
    ...openButton,
    ...cancelButton,
];
let iseditModalOpen: boolean = false;

export async function toggleeditModal(event: MouseEvent = null): Promise<void> {
    if (event !== null) event.stopPropagation();
    editModal &&
        editModal.forEach(async (editModal: HTMLFormElement): Promise<void> => {
            if (event) {
                const eventTarget = event.currentTarget as HTMLButtonElement;
                if (eventTarget.getAttribute("data-post-id")) {
                    const response: {title: string, content: string} = await postService.fetchPost(eventTarget.getAttribute("data-post-id"));
                    editModal.setAttribute("data-post-id", eventTarget.getAttribute("data-post-id"));
                    (editModal.querySelector("input[name='title']") as HTMLInputElement).value = response.title;
                    (editModal.querySelector("textarea") as HTMLTextAreaElement).value = response.content;                    
                }
            }
            editModal.classList.toggle("hidden");
            editModal.parentElement.parentElement.classList.toggle("hidden");
            iseditModalOpen = !iseditModalOpen;
        });
}

export default function handleeditModal(): void {
    document.addEventListener("click", (event: MouseEvent): void => {
        const eventTarget = event.target as HTMLElement;
        editModal &&
            editModal.forEach((editModal: HTMLFormElement) => {
                if (editModal)
                    !editModal.contains(eventTarget) &&
                        iseditModalOpen &&
                        toggleeditModal();
            });
    });
    actionButtons.forEach((actionButton: HTMLButtonElement): void => {
        actionButton && actionButton.addEventListener("click", toggleeditModal);
    });
}

handleeditModal();
