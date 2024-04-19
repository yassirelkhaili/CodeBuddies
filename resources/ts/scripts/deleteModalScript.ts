/** 
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/

import replyService from "../services/replyService";

    export default function handleDeleteModal (): void {
        const openButton = document.querySelectorAll(".delete-element-button") as NodeListOf<HTMLButtonElement>;
        const cancelButton = document.querySelectorAll(".cancel-delete-modal-element") as NodeListOf<HTMLButtonElement>;
        const deleteModal = document.querySelectorAll(".delete-element-form") as NodeListOf<HTMLFormElement>;
        const actionButtons: Array<HTMLButtonElement> = [...openButton, ...cancelButton];
        let isDeleteModalOpen: boolean = false;

        const toggleModal = (event: MouseEvent = null): void => {
            if (event !== null) event.stopPropagation();
            if (event !== null) {
                const eventTarget = event.target as HTMLElement;
            if (eventTarget.hasAttribute("data-reply-id")) {
                deleteModal && deleteModal.forEach((deleteModal: HTMLFormElement): void => {
                        const replyId: string = eventTarget.getAttribute("data-reply-id");
                        deleteModal && deleteModal.addEventListener("submit", async (event: Event): Promise<void> => {
                            event.preventDefault();
                            const response: string = await replyService.handleReplyDeletion(replyId);
                            document.getElementById("post-reply-results").innerHTML = response;
                            deleteModal.classList.toggle("hidden");
                            deleteModal.parentElement.parentElement.classList.toggle("hidden");
                            isDeleteModalOpen = !isDeleteModalOpen;
                        })
                });
            }
            }
            deleteModal && deleteModal.forEach((deleteModal: HTMLFormElement) => {
                if (deleteModal) {
                    deleteModal.classList.toggle("hidden");
                    deleteModal.parentElement.parentElement.classList.toggle("hidden");
                    isDeleteModalOpen = !isDeleteModalOpen;
                }
            })
        };

        document.addEventListener("click", (event: MouseEvent): void => {
            const eventTarget = event.target as HTMLElement;
            deleteModal && deleteModal.forEach((deleteModal: HTMLFormElement) => {
                if (deleteModal) (!deleteModal.contains(eventTarget) && isDeleteModalOpen) && toggleModal();
            })
        });

        actionButtons.forEach((actionButton: HTMLButtonElement): void => {
            actionButton && actionButton.addEventListener("click", toggleModal);
        });
    };

    handleDeleteModal();