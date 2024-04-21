import postService from "../services/postService";
import { reAttachPostEventListeners } from "../helpers";

export const handlePostUpvote = (): void => {
    const upvoteButtons = document.querySelectorAll(".upvote-post-button") as NodeListOf<HTMLButtonElement>;
    upvoteButtons && upvoteButtons.forEach((upvoteButton: HTMLButtonElement): void => {
        upvoteButton && upvoteButton.addEventListener("click", async (event: MouseEvent): Promise<void> => {
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