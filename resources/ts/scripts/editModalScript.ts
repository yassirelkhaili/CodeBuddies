/** 
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/
import replyService from "../services/replyService";

const openButton = document.querySelectorAll(".edit-element-button") as NodeListOf<HTMLButtonElement>;
const cancelButton = document.querySelectorAll(".cancel-edit-modal-element") as NodeListOf<HTMLButtonElement>;
const editModal = document.querySelectorAll(".edit-element-form") as NodeListOf<HTMLFormElement>;
const actionButtons: Array<HTMLButtonElement> = [...openButton, ...cancelButton];
let isEditModalOpen: boolean = false;

export async function toggleEditModal (event: MouseEvent = null): Promise<void> {
    if (event !== null) event.stopPropagation();
    editModal && editModal.forEach(async (editModal: HTMLFormElement): Promise<void> => {
        if (editModal) {
            if (event) {
                const eventTarget = event.target as HTMLElement;
                if (eventTarget.hasAttribute("data-reply-id")) {
                    editModal.setAttribute('data-reply-id', eventTarget.getAttribute('data-reply-id'));
                    const response: string = await replyService.fetchReplyContent(editModal.getAttribute("data-reply-id"));
                    const textArea = editModal.querySelector("textarea") as HTMLTextAreaElement;
                    textArea.value = response;
                }
            }
            editModal.classList.toggle("hidden");
            editModal.parentElement.parentElement.classList.toggle("hidden");
            isEditModalOpen = !isEditModalOpen;
        }
    });
};

    export default function handleEditModal (): void {
        document.addEventListener("click", (event: MouseEvent): void => {
            const eventTarget = event.target as HTMLElement;
            editModal && editModal.forEach((editModal: HTMLFormElement) => {
                if (editModal) (!editModal.contains(eventTarget) && isEditModalOpen) && toggleEditModal();
            })
        });
        actionButtons.forEach((actionButton: HTMLButtonElement): void => {
            actionButton && actionButton.addEventListener("click", toggleEditModal);
        });
    };

    handleEditModal();