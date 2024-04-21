import { toggleDeleteModal } from "./scripts/deleteModalScript";
import { toggleEditModal } from "./scripts/editModalScript";
import replyService from "./services/replyService";
import { handleReplyMarkAsAnswer, handleReplyUnmarkAsAnswer, handleReplyDownvote, handleReplyUpvote } from "./scripts/handleReplies";
import hljs from "highlight.js";

export default function extractForumIdFromUrl (): string {
    const pathname: string = window.location.pathname;
    return pathname.split('/')[2];
}

export function extractThreadIdFromUrl (): string {
    const pathname: string = window.location.pathname;
    return pathname.split('/')[3];
}

export function extractPostIdFromUrl (): string {
    const pathname: string = window.location.pathname;
    return pathname.split('/')[4];
}

export async function updateResponseCount (): Promise<void> {
    const countContainer = document.getElementById("response-count") as HTMLSpanElement;
    const responseCount: string = await replyService.updateResponeCount(extractPostIdFromUrl());
    const responseCountResultString: string = parseInt(responseCount, 10) > 1 ? responseCount + " responses" : responseCount + "response";
    countContainer.textContent = responseCountResultString;
}

export function reAttachEventListeners (): void {
    const deleteButtons = document.querySelectorAll(".delete-element-button");
        deleteButtons.forEach((deleteButton: HTMLButtonElement) => deleteButton && deleteButton.addEventListener("click", toggleDeleteModal));
    const editButtons = document.querySelectorAll(".edit-element-button");
    editButtons.forEach((editButton: HTMLButtonElement) => editButton && editButton.addEventListener("click", toggleEditModal));
    updateResponseCount();
    handleReplyMarkAsAnswer();
    handleReplyUnmarkAsAnswer();
    handleReplyDownvote();
    handleReplyUpvote();
    hljs.highlightAll();
}