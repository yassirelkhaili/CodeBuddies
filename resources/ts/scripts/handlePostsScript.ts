import postService from "../services/postService";
import { reAttachPostEventListeners } from "../helpers";
import { toggleEditModal } from "./editModalScript";

export const handlePostUpvote = (): void => {
    const editButtons = document.querySelectorAll(".upvote-post-button") as NodeListOf<HTMLButtonElement>;
    editButtons && editButtons.forEach((deleteButton: HTMLButtonElement): void => {
        deleteButton && deleteButton.addEventListener("click", async (event: MouseEvent): Promise<void> => {
            event.stopPropagation();
            const eventTarget = event.currentTarget as HTMLButtonElement;
            const postId: string = eventTarget.getAttribute("data-post-id");
            const response: string = await postService.upvotePost(postId);
            document.getElementById("vote-results").innerHTML = response;
            reAttachPostEventListeners();
        })
    })
};

handlePostUpvote();

export const handlePostDownvote = (): void => {
    const downvoteButtons = document.querySelectorAll(".downvote-post-button") as NodeListOf<HTMLButtonElement>;
    downvoteButtons && downvoteButtons.forEach((downvoteButton: HTMLButtonElement): void => {
        downvoteButton && downvoteButton.addEventListener("click", async (event: MouseEvent): Promise<void> => {
            event.stopPropagation();
            const eventTarget = event.currentTarget as HTMLButtonElement;
            const postId: string = eventTarget.getAttribute("data-post-id");
            const response: string = await postService.downvotePost(postId);
            document.getElementById("vote-results").innerHTML = response;
            reAttachPostEventListeners();
        })
    })
};

handlePostDownvote();

export const handlePostCreation = (): void => {
    const editModal = document.querySelectorAll(
        ".create-post-form"
    ) as NodeListOf<HTMLFormElement>;
    editModal &&
        editModal.forEach((editModal: HTMLFormElement): void => {
            editModal &&
                editModal.addEventListener("submit", async (event: SubmitEvent): Promise<void> => {
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
                    toggleEditModal();
                    document.getElementById("filter-results-posts").innerHTML = response;
                });
        });
};

handlePostCreation();

export const handlePostDeleteAction = (): void => {
    const editButtons = document.querySelectorAll(".delete-post-button") as NodeListOf<HTMLButtonElement>;
    editButtons && editButtons.forEach((deleteButton: HTMLButtonElement): void => {
        deleteButton && deleteButton.addEventListener("click", async (event: MouseEvent): Promise<void> => {
            event.stopPropagation();
            const eventTarget = event.currentTarget as HTMLButtonElement;
            const postId: string = eventTarget.getAttribute("data-post-id");
            const response: string = await postService.deletePost(postId);
            document.getElementById("filter-results-posts").innerHTML = response;
            reAttachPostEventListeners();
        })
    })
};

handlePostDeleteAction();

export const handlePostEditAction = (): void => {
    const editModal = document.querySelectorAll(
        ".edit-post-form"
    ) as NodeListOf<HTMLFormElement>;
    editModal &&
        editModal.forEach((editModal: HTMLFormElement): void => {
            editModal &&
                editModal.addEventListener("submit", async (event: SubmitEvent): Promise<void> => {
                    event.preventDefault();
                    const eventTarget = event.target as HTMLFormElement;
                    const postId = eventTarget.getAttribute("data-post-id");
                    const formData = new FormData(eventTarget);
                    const formProps: Record<string, any> = {};
                    formData.forEach((value, key) => {
                        formProps[key] = value;
                    });
                    const response: string = await postService.editPost(
                        eventTarget.getAttribute("data-post-id"),
                        formProps
                    );
                    toggleEditModal();
                    document.getElementById("filter-results-posts").innerHTML = response;
                });
        });
};

handlePostEditAction();