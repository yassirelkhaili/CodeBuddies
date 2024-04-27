/**
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/

const openButton = document.querySelectorAll(
    ".open-create-forum-button"
) as NodeListOf<HTMLButtonElement>;
const cancelButton = document.querySelectorAll(
    ".cancel-forum-modal-element"
) as NodeListOf<HTMLButtonElement>;
const forumModal = document.querySelectorAll(
    ".create-forum-form"
) as NodeListOf<HTMLFormElement>;
const actionButtons: Array<HTMLButtonElement> = [
    ...openButton,
    ...cancelButton,
];
let isforumModalOpen: boolean = false;

export async function toggleforumModal(event: MouseEvent = null): Promise<void> {
    if (event !== null) event.stopPropagation();
    forumModal &&
        forumModal.forEach(async (forumModal: HTMLFormElement): Promise<void> => {
            forumModal.classList.toggle("hidden");
            forumModal.parentElement.parentElement.classList.toggle("hidden");
            isforumModalOpen = !isforumModalOpen;
        });
}

export default function handleforumModal(): void {
    document.addEventListener("click", (event: MouseEvent): void => {
        const eventTarget = event.target as HTMLElement;
        forumModal &&
            forumModal.forEach((forumModal: HTMLFormElement) => {
                if (forumModal)
                    !forumModal.contains(eventTarget) &&
                        isforumModalOpen &&
                        toggleforumModal();
            });
    });
    actionButtons.forEach((actionButton: HTMLButtonElement): void => {
        actionButton && actionButton.addEventListener("click", toggleforumModal);
    });
}

handleforumModal();
