import postService from "../services/postService";
import { reAttachPostEventListeners } from "../helpers";
import { togglepostModal } from "./createPostModalScript";
import { togglePostEditModal } from "./editPostModalScript";

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
    const postModal = document.querySelector(
        ".create-post-form"
    ) as HTMLFormElement;
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
                    document.getElementById("filter-results-posts").innerHTML = response;
                    togglepostModal();
                    reAttachPostEventListeners();
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
    const editModal = document.querySelector(
        ".edit-post-form"
    ) as HTMLFormElement;
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
                        postId,
                        formProps
                    );
                    document.getElementById("filter-results-posts").innerHTML = response;
                    togglePostEditModal();
                    reAttachPostEventListeners();
                });
};

handlePostEditAction();