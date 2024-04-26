import axios from "axios";

class ThreadService {
    private BASE_URL = import.meta.env.VITE_APP_URL + "/threads" || "";

    public async createThread(forumId: string, formProps: Record<string, any>): Promise<string> {
        try {
            const response = await axios.post<string>(`${this.BASE_URL}/resource`, {forum_id: forumId, ...formProps});
            return response.data;
        } catch (error) {
            if (axios.isAxiosError(error)) {
                if (error.response && error.response.status === 403) {
                    window.location.href = '/login';
                }
            }
            console.error("An error occurred:", error);
            throw error;
        }
    }

    public async deleteThread(threadId: string): Promise<string> {
        try {
            const response = await axios.delete<string>(`${this.BASE_URL}/resource/${threadId}`);
            return response.data;
        } catch (error) {
            if (axios.isAxiosError(error)) {
                if (error.response && error.response.status === 403) {
                    window.location.href = '/login';
                }
            }
            console.error("An error occurred:", error);
            throw error;
        }
    }

   public async editThread(threadId: string, content: Record<string, any>): Promise<string> {
        try {
            const response = await axios.put<string>(`${this.BASE_URL}/resource/${threadId}`, {...content});
            return response.data;
        } catch (error) {
            if (axios.isAxiosError(error)) {
                if (error.response && error.response.status === 403) {
                    window.location.href = '/login';
                }
            }
            console.error("An error occurred:", error);
            throw error;
        }
    }

    public async fetchThread(threadId: string): Promise<{title: string, content: string}> {
        try {
            const response = await axios.get<{title: string, content: string}>(`${this.BASE_URL}/resource/fetch/${threadId}`);
            return response.data;
        } catch (error) {
            if (axios.isAxiosError(error)) {
                if (error.response && error.response.status === 403) {
                    window.location.href = '/login';
                }
            }
            console.error("An error occurred:", error);
            throw error;
        }
    }
}
const threadService = new ThreadService();

export default threadService;
