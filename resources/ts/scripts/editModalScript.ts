/** 
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/
const openButton = document.querySelectorAll(".edit-element-button") as NodeListOf<HTMLButtonElement>;
const cancelButton = document.querySelectorAll(".cancel-edit-modal-element") as NodeListOf<HTMLButtonElement>;
const editModal = document.querySelectorAll(".edit-element-form") as NodeListOf<HTMLFormElement>;
const actionButtons: Array<HTMLButtonElement> = [...openButton, ...cancelButton];
let isEditModalOpen: boolean = false;

export async function toggleModal (event: MouseEvent = null): Promise<void> {
    if (event !== null) event.stopPropagation();
    editModal && editModal.forEach((editModal: HTMLFormElement) => {
        if (editModal) {
            if (event) {
                const eventTarget = event.target as HTMLElement;
                if (eventTarget.hasAttribute("data-reply-id")) {
                    editModal.setAttribute('data-reply-id', eventTarget.getAttribute('data-reply-id'));
                }
            }
        }
    });
    editModal && editModal.forEach((editModal: HTMLFormElement) => {
        if (editModal) {
            editModal.classList.toggle("hidden");
            editModal.parentElement.parentElement.classList.toggle("hidden");
            isEditModalOpen = !isEditModalOpen;
        }
    })
};

    export default function handleEditModal (): void {
        document.addEventListener("click", (event: MouseEvent): void => {
            const eventTarget = event.target as HTMLElement;
            editModal && editModal.forEach((editModal: HTMLFormElement) => {
                if (editModal) (!editModal.contains(eventTarget) && isEditModalOpen) && toggleModal();
            })
        });
        actionButtons.forEach((actionButton: HTMLButtonElement): void => {
            actionButton && actionButton.addEventListener("click", toggleModal);
        });
    };

    handleEditModal();