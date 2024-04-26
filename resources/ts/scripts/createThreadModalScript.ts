/**
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/

const openButton = document.querySelectorAll(
    ".open-create-thread-button"
) as NodeListOf<HTMLButtonElement>;
const cancelButton = document.querySelectorAll(
    ".cancel-thread-modal-element"
) as NodeListOf<HTMLButtonElement>;
const threadModal = document.querySelectorAll(
    ".create-thread-form"
) as NodeListOf<HTMLFormElement>;
const actionButtons: Array<HTMLButtonElement> = [
    ...openButton,
    ...cancelButton,
];
let isthreadModalOpen: boolean = false;

export async function togglethreadModal(event: MouseEvent = null): Promise<void> {
    if (event !== null) event.stopPropagation();
    threadModal &&
        threadModal.forEach(async (threadModal: HTMLFormElement): Promise<void> => {
            threadModal.classList.toggle("hidden");
            threadModal.parentElement.parentElement.classList.toggle("hidden");
            isthreadModalOpen = !isthreadModalOpen;
        });
}

export default function handlethreadModal(): void {
    document.addEventListener("click", (event: MouseEvent): void => {
        event.stopPropagation();
        const eventTarget = event.target as HTMLElement;
        threadModal &&
            threadModal.forEach((threadModal: HTMLFormElement) => {
                if (threadModal)
                    !threadModal.contains(eventTarget) &&
                        isthreadModalOpen &&
                        togglethreadModal();
            });
    });
    actionButtons.forEach((actionButton: HTMLButtonElement): void => {
        actionButton && actionButton.addEventListener("click", togglethreadModal);
    });
}

handlethreadModal();
