/** 
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/

import { extractPostIdFromUrl } from "../helpers";
import replyService from "../services/replyService";
import { reAttachEventListeners } from "../helpers";
import { toggleDeleteModal } from "./deleteModalScript";
import { toggleEditModal } from "./editModalScript";

    const handleReplyPostAction = (): void => {
        const form = document.getElementById('create-reply-form') as HTMLFormElement;
        if (form) {
            form.addEventListener("submit", async (event: Event): Promise<void> => {
                event.preventDefault();
                const searchInput = document.getElementById('reply-editor') as HTMLInputElement;
                if (searchInput) {
                    const searchValue: string = searchInput.value;
                    searchInput.value = "";
                    const postId: string = extractPostIdFromUrl();
                    const response: string = await replyService.handleReplySubmission(searchValue, postId);
                    document.getElementById("post-reply-results").innerHTML = response;
                    reAttachEventListeners();
                }
            });
        }
    };

    handleReplyPostAction();

    const handleReplyDeletion = (): void => {
        const deleteModal = document.querySelector(".delete-element-form") as HTMLFormElement;
        deleteModal && deleteModal.addEventListener("submit", async (event: MouseEvent): Promise<void> => {
            event.preventDefault();
            const eventTarget = event.target as HTMLButtonElement;
            const replyId: string = eventTarget.getAttribute("data-reply-id");
            const response: string = await replyService.handleReplyDeletion(replyId);
            document.getElementById("post-reply-results").innerHTML = response;
            toggleDeleteModal();
            reAttachEventListeners();
            })
    }

    handleReplyDeletion();

    const handleReplyEditionAction = (): void => {
        const form = document.querySelector(".edit-element-form") as HTMLFormElement;
        if (form) {
            form.addEventListener("submit", async (event: Event): Promise<void> => {
                event.preventDefault();
                const textArea = form.querySelector('textarea') as HTMLTextAreaElement;
                if (textArea) {
                    const textAreaValue: string = textArea.value;
                    const postId: string = extractPostIdFromUrl();
                    console.log(form.getAttribute("data-reply-id"))
                    const response: string = await replyService.handleReplyEdition(textAreaValue, form.getAttribute("data-reply-id"), postId);
                    document.getElementById("post-reply-results").innerHTML = response;
                    toggleEditModal();
                    reAttachEventListeners();
                }
            });
        }
    };

    handleReplyEditionAction();

    export const handleReplyMarkAsAnswer = (): void => {
        const markButtons = document.querySelectorAll(".mark-element-button") as NodeListOf<HTMLButtonElement>;
        markButtons && markButtons.forEach((markButton: HTMLButtonElement): void => {
            markButton && markButton.addEventListener("click", async (event: MouseEvent): Promise<void> => {
                const eventTarget = event.target as HTMLButtonElement;
                const replyId: string = eventTarget.getAttribute("data-reply-id");
                const postId: string = extractPostIdFromUrl();
                const response: string = await replyService.markReponseAsAnswer(replyId, postId);
                document.getElementById("post-reply-results").innerHTML = response;
                reAttachEventListeners();
            })
        })
    };

    handleReplyMarkAsAnswer();

    export const handleReplyUnmarkAsAnswer = (): void => {
        const unmarkButtons = document.querySelectorAll(".unmark-element-button") as NodeListOf<HTMLButtonElement>;
        unmarkButtons && unmarkButtons.forEach((unmarkButton: HTMLButtonElement): void => {
            unmarkButton && unmarkButton.addEventListener("click", async (event: MouseEvent): Promise<void> => {
                const eventTarget = event.target as HTMLButtonElement;
                const replyId: string = eventTarget.getAttribute("data-reply-id");
                const postId: string = extractPostIdFromUrl();
                const response: string = await replyService.unmarkReponseAsAnswer(replyId, postId);
                document.getElementById("post-reply-results").innerHTML = response;
                reAttachEventListeners();
            })
        })
    };

    handleReplyUnmarkAsAnswer();

    export const handleReplyUpvote = (): void => {
        const upvoteButtons = document.querySelectorAll(".upvote-button") as NodeListOf<HTMLButtonElement>;
        upvoteButtons && upvoteButtons.forEach((upvoteButton: HTMLButtonElement): void => {
            upvoteButton && upvoteButton.addEventListener("click", async (event: MouseEvent): Promise<void> => {
                const eventTarget = event.target as HTMLButtonElement;
                const replyId: string = eventTarget.getAttribute("data-reply-id");
                const response: string = await replyService.upvoteReponse(replyId);
                document.getElementById("post-reply-results").innerHTML = response;
                reAttachEventListeners();
            })
        })
    };

    handleReplyUpvote();

    export const handleReplyDownvote = (): void => {
        const downvoteButtons = document.querySelectorAll(".downvote-button") as NodeListOf<HTMLButtonElement>;
        downvoteButtons && downvoteButtons.forEach((downvoteButton: HTMLButtonElement): void => {
            downvoteButton && downvoteButton.addEventListener("click", async (event: MouseEvent): Promise<void> => {
                const eventTarget = event.target as HTMLButtonElement;
                const replyId: string = eventTarget.getAttribute("data-reply-id");
                const response: string = await replyService.downvoteResponse(replyId);
                document.getElementById("post-reply-results").innerHTML = response;
                reAttachEventListeners();
            })
        })
    };

    handleReplyDownvote();
 