/**
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/

const openButton = document.querySelectorAll(
    ".open-create-post-button"
) as NodeListOf<HTMLButtonElement>;
const cancelButton = document.querySelectorAll(
    ".cancel-post-modal-element"
) as NodeListOf<HTMLButtonElement>;
const postModal = document.querySelector(
    ".create-post-form"
) as HTMLFormElement;
const actionButtons: Array<HTMLButtonElement> = [
    ...openButton,
    ...cancelButton,
];
let isPostModalOpen: boolean = false;

export async function togglepostModal(event: MouseEvent = null): Promise<void> {
    if (event !== null) event.stopPropagation();
    postModal.classList.toggle("hidden");
    postModal.parentElement.parentElement.classList.toggle("hidden");
    isPostModalOpen = !isPostModalOpen;
}

export default function handlepostModal(): void {
    document.addEventListener("click", (event: MouseEvent): void => {
        const eventTarget = event.target as HTMLElement;
                if (postModal)
                    !postModal.contains(eventTarget) &&
                        isPostModalOpen &&
                        togglepostModal();
            });
    actionButtons.forEach((actionButton: HTMLButtonElement): void => {
        actionButton && actionButton.addEventListener("click", togglepostModal);
    });
}

handlepostModal();
