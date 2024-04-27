/**
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/

import forumService from "../services/forumService";

const openButton = document.querySelectorAll(
    ".edit-forum-model-button"
) as NodeListOf<HTMLButtonElement>;
const cancelButton = document.querySelectorAll(
    ".cancel-edit-forum-modal-element"
) as NodeListOf<HTMLButtonElement>;
const editModal = document.querySelectorAll(
    ".edit-forum-form"
) as NodeListOf<HTMLFormElement>;
const actionButtons: Array<HTMLButtonElement> = [
    ...openButton,
    ...cancelButton,
];
let iseditModalOpen: boolean = false;

export async function toggleForumEditModal(event: MouseEvent = null): Promise<void> {
    if (event !== null) event.stopPropagation();
    editModal &&
        editModal.forEach(async (editModal: HTMLFormElement): Promise<void> => {
            if (event) {
                const eventTarget = event.currentTarget as HTMLButtonElement;
                if (eventTarget.getAttribute("data-forum-id")) {
                    const response: {title: string, content: string, avatar: string} = await forumService.fetchForum(eventTarget.getAttribute("data-forum-id"));
                    editModal.setAttribute("data-forum-id", eventTarget.getAttribute("data-forum-id"));
                    (editModal.querySelector("input[name='name']") as HTMLInputElement).value = response.title;
                    (editModal.querySelector("input[name='avatar']") as HTMLInputElement).value = response.avatar;
                    (editModal.querySelector("textarea") as HTMLTextAreaElement).value = response.content;                    
                }
            }
            editModal.classList.toggle("hidden");
            editModal.parentElement.parentElement.classList.toggle("hidden");
            console.log(editModal);
            iseditModalOpen = !iseditModalOpen;
        });
}

export default function handleForumEditModal(): void {
    document.addEventListener("click", (event: MouseEvent): void => {
        const eventTarget = event.target as HTMLElement;
        editModal &&
            editModal.forEach((editModal: HTMLFormElement) => {
                if (editModal)
                    !editModal.contains(eventTarget) &&
                        iseditModalOpen &&
                        toggleForumEditModal();
            });
    });
    actionButtons.forEach((actionButton: HTMLButtonElement): void => {
        actionButton && actionButton.addEventListener("click", toggleForumEditModal);
    });
}

handleForumEditModal();
