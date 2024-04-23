/** 
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/

import searchService from "../services/searchService";
import extractForumIdFromUrl, { extractThreadIdFromUrl } from "../helpers";

document.addEventListener("DOMContentLoaded", (): void => {
    const handleForumSearchAction = (): void => {
        const form = document.getElementById('search-form') as HTMLFormElement;
        if (form) {
            form.addEventListener("submit", async (event: Event): Promise<void> => {
                event.preventDefault();
                const searchInput = document.getElementById('default-search') as HTMLInputElement;
                if (searchInput) {
                    const searchValue: string = searchInput.value.trim();
                    const response: string = await searchService.handleForumSearch(searchValue);
                    document.getElementById("search-results").innerHTML = response;
                }
            });
        }
    };

    handleForumSearchAction();

    const handleThreadFilterAction = (): void => {
        const form = document.getElementById('filter-form-threads') as HTMLFormElement;
        if (form) {
            form.addEventListener("keyup", async (event: Event): Promise<void> => {
                event.preventDefault();
                const filterInput = document.getElementById('threads-filter') as HTMLInputElement;
                if (filterInput) {
                    const filterValue: string = filterInput.value.trim();
                    const forumId: string = extractForumIdFromUrl();
                    const response: string = await searchService.handleThreadFilter(filterValue, forumId);
                    document.getElementById("filter-results-threads").innerHTML = response;
                }
            });
        }
    };

    handleThreadFilterAction();

    const handlePostFilterAction = (): void => {
        const form = document.getElementById('filter-form-posts') as HTMLFormElement;
        if (form) {
            form.addEventListener("keyup", async (event: Event): Promise<void> => {
                event.preventDefault();
                const filterInput = document.getElementById('posts-filter') as HTMLInputElement;
                if (filterInput) {
                    const filterValue: string = filterInput.value.trim();
                    const threadId: string = extractThreadIdFromUrl();
                    const response: string = await searchService.handleThreadFilter(filterValue, threadId);
                    document.getElementById("filter-results-posts").innerHTML = response;
                    console.log(document.getElementById("filter-results-posts"))
                }
            });
        }
    };

    handlePostFilterAction();
});
