import axios from "axios";

class ForumService {
    private BASE_URL = import.meta.env.VITE_APP_URL + "/forums" || "";

    public async createForum(formProps: Record<string, any>): Promise<string> {
        try {
            const response = await axios.post<string>(`${this.BASE_URL}/resource`, {...formProps});
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

    public async deleteForum(forumId: string): Promise<string> {
        try {
            const response = await axios.delete<string>(`${this.BASE_URL}/resource/${forumId}`);
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

   public async editForum(forumId: string, content: Record<string, any>): Promise<string> {
        try {
            const response = await axios.put<string>(`${this.BASE_URL}/resource/${forumId}`, {...content});
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

    public async fetchForum(forumId: string): Promise<{title: string, content: string, avatar: string}> {
        try {
            const response = await axios.get<{title: string, content: string, avatar: string}>(`${this.BASE_URL}/resource/fetch/${forumId}`);
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
const forumService = new ForumService();

export default forumService;
