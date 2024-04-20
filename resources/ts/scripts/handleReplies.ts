/** 
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/

import { extractPostIdFromUrl } from "../helpers";
import replyService from "../services/replyService";
import hljs from 'highlight.js';
import { toggleDeleteModal } from "./deleteModalScript";
import { reAttachDeleteEventListeners } from "./deleteModalScript";
import { reAttachEditEventListeners, toggleEditModal } from "./editModalScript";

document.addEventListener("DOMContentLoaded", (): void => {
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
                    reAttachDeleteEventListeners();
                    reAttachEditEventListeners();
                    hljs.highlightAll();
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
            reAttachDeleteEventListeners();
            reAttachEditEventListeners();
            hljs.highlightAll();
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
                    reAttachDeleteEventListeners();
                    reAttachEditEventListeners();
                    hljs.highlightAll();
                }
            });
        }
    };

    handleReplyEditionAction();
});
 