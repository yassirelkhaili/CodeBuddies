import { toggleDeleteModal } from "./scripts/deleteModalScript";
import { toggleEditModal } from "./scripts/editModalScript";
import { toggleThreadEditModal } from "./scripts/editThreadModalScript";
import replyService from "./services/replyService";
import { handleReplyMarkAsAnswer, handleReplyUnmarkAsAnswer, handleReplyDownvote, handleReplyUpvote } from "./scripts/handleReplies";
import hljs from "highlight.js";
import { handlePostDeleteAction, handlePostDownvote, handlePostEditAction, handlePostUpvote } from "./scripts/handlePostsScript";
import handlethreadModal from "./scripts/createThreadModalScript";
import { ContentType, handleDropDownToggle } from "./scripts/modifyContentDropdownScript";
import { handleThreadDeleteAction } from "./scripts/handleThreads";
import { handleForumforumDeleteAction, handleforumEditAction } from "./scripts/handleForums";
import { toggleForumEditModal } from "./scripts/editForumModalScript";
import handleforumModal from "./scripts/createForumModalScript";
import handlepostModal, { togglepostModal } from "./scripts/createPostModalScript";
import { togglePostEditModal } from "./scripts/editPostModalScript";

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

export function reAttachPostEventListeners (): void {
    handlePostDownvote();
    handlePostUpvote();
    handleDropDownToggle(ContentType.POST);
    handlePostDeleteAction();
    const editButtons = document.querySelectorAll(".edit-post-model-button");
    editButtons.forEach((editButton: HTMLButtonElement) => editButton && editButton.addEventListener("click", togglePostEditModal));
}

export function reAttachThreadEventListeners (): void {
    handlethreadModal();
    const editButtons = document.querySelectorAll(".edit-thread-model-button");
    editButtons.forEach((editButton: HTMLButtonElement) => editButton && editButton.addEventListener("click", toggleThreadEditModal));
    handleDropDownToggle(ContentType.THREAD);
    handleThreadDeleteAction();
}

export function reAttachForumEventListeners (): void {
    handleforumModal();
    const editButtons = document.querySelectorAll(".edit-forum-model-button");
    editButtons.forEach((editButton: HTMLButtonElement) => editButton && editButton.addEventListener("click", toggleForumEditModal));
 handleDropDownToggle(ContentType.FORUM);
 handleForumforumDeleteAction();
}