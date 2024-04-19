/** 
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/

import replyService from "../services/replyService";

    export default function handleEditModal (): void {
        const openButton = document.querySelectorAll(".edit-element-button") as NodeListOf<HTMLButtonElement>;
        const cancelButton = document.querySelectorAll(".cancel-edit-modal-element") as NodeListOf<HTMLButtonElement>;
        const editModal = document.querySelectorAll(".edit-element-form") as NodeListOf<HTMLFormElement>;
        const actionButtons: Array<HTMLButtonElement> = [...openButton, ...cancelButton];
        let isEditModalOpen: boolean = false;

        const toggleModal = async (event: MouseEvent = null): Promise<void> => {
            if (event !== null) event.stopPropagation();
            if (event !== null) {
                const eventTarget = event.target as HTMLElement;
            if (eventTarget.hasAttribute("data-reply-id") && !isEditModalOpen) {
                const replyId: string = eventTarget.getAttribute("data-reply-id");
                const response: string = await replyService.fetchReplyContent(replyId);
                const textArea = document.querySelectorAll(".reply-textarea") as NodeListOf<HTMLTextAreaElement>;
                textArea.forEach((textArea: HTMLTextAreaElement) => textArea.value = response);
                editModal && editModal.forEach((editModal: HTMLFormElement): void => {
                        editModal && editModal.addEventListener("submit", async (event: Event): Promise<void> => {
                            event.preventDefault();
                            const response: string = await replyService.handleReplyDeletion(replyId);
                            document.getElementById("post-reply-results").innerHTML = response;
                            editModal.classList.toggle("hidden");
                            editModal.parentElement.parentElement.classList.toggle("hidden");
                            isEditModalOpen = !isEditModalOpen;
                        })
                });
            }
            }
            editModal && editModal.forEach((editModal: HTMLFormElement) => {
                if (editModal) {
                    editModal.classList.toggle("hidden");
                    editModal.parentElement.parentElement.classList.toggle("hidden");
                    isEditModalOpen = !isEditModalOpen;
                }
            })
        };

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