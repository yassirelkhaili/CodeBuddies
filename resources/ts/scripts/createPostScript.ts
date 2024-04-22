/**
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/
import postService from "../services/postService";

const openButton = document.querySelectorAll(
    ".open-create-post-button"
) as NodeListOf<HTMLButtonElement>;
const cancelButton = document.querySelectorAll(
    ".cancel-post-modal-element"
) as NodeListOf<HTMLButtonElement>;
const postModal = document.querySelectorAll(
    ".create-post-form"
) as NodeListOf<HTMLFormElement>;
const actionButtons: Array<HTMLButtonElement> = [
    ...openButton,
    ...cancelButton,
];
let isPostModalOpen: boolean = false;

export async function togglepostModal(event: MouseEvent = null): Promise<void> {
    if (event !== null) event.stopPropagation();
    postModal &&
        postModal.forEach(async (postModal: HTMLFormElement): Promise<void> => {
            postModal.classList.toggle("hidden");
            postModal.parentElement.parentElement.classList.toggle("hidden");
            isPostModalOpen = !isPostModalOpen;
        });
}

export default function handlepostModal(): void {
    document.addEventListener("click", (event: MouseEvent): void => {
        const eventTarget = event.target as HTMLElement;
        postModal &&
            postModal.forEach((postModal: HTMLFormElement) => {
                if (postModal)
                    !postModal.contains(eventTarget) &&
                        isPostModalOpen &&
                        togglepostModal();
            });
    });
    actionButtons.forEach((actionButton: HTMLButtonElement): void => {
        actionButton && actionButton.addEventListener("click", togglepostModal);
    });
}

handlepostModal();

export const handlePostCreation = (): void => {
    postModal &&
        postModal.forEach((postModal: HTMLFormElement): void => {
            postModal &&
                postModal.addEventListener("submit", async (event: SubmitEvent): Promise<void> => {
                    event.preventDefault();
                    const eventTarget = event.target as HTMLFormElement;
                    const threadId = eventTarget.getAttribute("data-thread-id");
                    const formData = new FormData(eventTarget);
                    const formProps: Record<string, any> = {};
                    formData.forEach((value, key) => {
                        formProps[key] = value;
                    });
                    const response: string = await postService.createPost(
                        threadId,
                        formProps
                    );
                    togglepostModal();
                    document.querySelector(".filter-results-posts").innerHTML = response;
                });
        });
};

handlePostCreation();
