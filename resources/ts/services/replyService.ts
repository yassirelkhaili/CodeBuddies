import axios from "axios";

class ReplyService {
    private BASE_URL = import.meta.env.VITE_APP_URL + "/replies" || "";

    public async handleReplySubmission(reply: string, postId: string): Promise<string> {
        try {
            const response = await axios.post<string>(`${this.BASE_URL}`, {reply: reply, post_id: postId});
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

    public async handleReplyEdition(reply: string, replyId: string, postId: string): Promise<string> {
        try {
            const response = await axios.put<string>(`${this.BASE_URL}/${replyId}`, { reply: reply, post_id: postId });
            return response.data;
        } catch (error) {
            console.error("An error occurred:", error);
            throw error; 
        }
    }

    public async handleReplyDeletion(replyId: string): Promise<string> {
        try {
            const response = await axios.delete<string>(`${this.BASE_URL}/${replyId}`);
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

    public async fetchReplyContent(contentId: string): Promise<string> {
        try {
            const response = await axios.get<string>(`${this.BASE_URL}/${contentId}`);
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

    public async markReponseAsAnswer(replyId: string, postId: string): Promise<string> {
        try {
            const response = await axios.post<string>(`${this.BASE_URL}/mark/${replyId}`, { post_id: postId });
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

    public async unmarkReponseAsAnswer(replyId: string, postId: string): Promise<string> {
        try {
            const response = await axios.post<string>(`${this.BASE_URL}/unmark/${replyId}`, { post_id: postId });
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

    public async updateResponeCount(postId: string): Promise<string> {
        try {
            const response = await axios.get<string>(`${this.BASE_URL}/responseCount/${postId}`);
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

    public async upvoteReponse(replyId: string): Promise<string> {
        try {
            const response = await axios.post<string>(`${this.BASE_URL}/upvote/${replyId}`);
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

    public async downvoteResponse(replyId: string): Promise<string> {
        try {
            const response = await axios.post<string>(`${this.BASE_URL}/downvote/${replyId}`);
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

const replyService = new ReplyService();

export default replyService;
