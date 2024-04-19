/** 
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/

    const openButton = document.querySelectorAll(".delete-element-button") as NodeListOf<HTMLButtonElement>;
    const cancelButton = document.querySelectorAll(".cancel-delete-modal-element") as NodeListOf<HTMLButtonElement>;
    const deleteModal = document.querySelectorAll(".delete-element-form") as NodeListOf<HTMLFormElement>;
    const actionButtons: Array<HTMLButtonElement> = [...openButton, ...cancelButton];
    let isDeleteModalOpen: boolean = false;

    export function reAttachDeleteEventListeners (): void {
        const deleteButtons = document.querySelectorAll(".delete-element-button");
        deleteButtons.forEach((deleteButton: HTMLButtonElement) => deleteButton && deleteButton.addEventListener("click", toggleDeleteModal));
    }

    export function toggleDeleteModal (event: MouseEvent = null): void {
        if (event !== null) event.stopPropagation();
        deleteModal && deleteModal.forEach((deleteModal: HTMLFormElement) => {
            if (deleteModal) {
                if (event) {
                    const eventTarget = event.target as HTMLElement;
                    if (eventTarget.hasAttribute("data-reply-id")) {
                        deleteModal.setAttribute('data-reply-id', eventTarget.getAttribute('data-reply-id'));
                    }
                }
                deleteModal.classList.toggle("hidden");
                deleteModal.parentElement.parentElement.classList.toggle("hidden");
                isDeleteModalOpen = !isDeleteModalOpen;
            }
        })
    };

    export default function handleDeleteModal (): void {
        document.addEventListener("click", (event: MouseEvent): void => {
            const eventTarget = event.target as HTMLElement;
            deleteModal && deleteModal.forEach((deleteModal: HTMLFormElement) => {
                if (deleteModal) (!deleteModal.contains(eventTarget) && isDeleteModalOpen) && toggleDeleteModal();
            })
        });

        actionButtons.forEach((actionButton: HTMLButtonElement): void => {
            actionButton && actionButton.addEventListener("click", toggleDeleteModal);
        });
    };

    handleDeleteModal();