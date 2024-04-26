/**
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/

import threadService from "../services/threadService";

const openButton = document.querySelectorAll(
    ".edit-thread-model-button"
) as NodeListOf<HTMLButtonElement>;
const cancelButton = document.querySelectorAll(
    ".cancel-edit-thread-modal-element"
) as NodeListOf<HTMLButtonElement>;
const editModal = document.querySelector(
    ".edit-thread-form"
) as HTMLFormElement;
const actionButtons: Array<HTMLButtonElement> = [
    ...openButton,
    ...cancelButton,
];
let iseditModalOpen: boolean = false;

export async function toggleThreadEditModal(event: MouseEvent = null): Promise<void> {
    if (event !== null) event.stopPropagation();
            if (event) {
                const eventTarget = event.target as HTMLButtonElement;
                if (eventTarget.getAttribute("data-thread-id")) {
                    const response: {title: string, content: string} = await threadService.fetchThread(eventTarget.getAttribute("data-thread-id"));
                    editModal.setAttribute("data-thread-id", eventTarget.getAttribute("data-thread-id"));
                    (editModal.querySelector("input[name='name']") as HTMLInputElement).value = response.title;
                    (editModal.querySelector("textarea[name='description']") as HTMLTextAreaElement).value = response.content;                    
                }
            }
            editModal.classList.toggle("hidden");
            editModal.parentElement.parentElement.classList.toggle("hidden");
            iseditModalOpen = !iseditModalOpen;
}

export default function handleThreadEditModal(): void {
    document.addEventListener("click", (event: MouseEvent): void => {
        const eventTarget = event.target as HTMLElement;
                if (editModal)
                    !editModal.contains(eventTarget) &&
                        iseditModalOpen &&
                        toggleThreadEditModal();
    });
    actionButtons.forEach((actionButton: HTMLButtonElement): void => {
        actionButton && actionButton.addEventListener("click", toggleThreadEditModal);
    });
}

handleThreadEditModal();
