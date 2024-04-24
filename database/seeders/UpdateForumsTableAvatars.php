<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Interfaces\ForumRepositoryInterface;

class UpdateForumsTableAvatars extends Seeder
{
    protected ForumRepositoryInterface $forumRepository;

    public function __construct(ForumRepositoryInterface $forumRepository) {
        $this->forumRepository = $forumRepository;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $forums = [
            ['name' => 'General Programming', 'description' => 'Discussions on programming fundamentals, logic, algorithms, and best practices.', 'avatar' => 'fa-code'],
            ['name' => 'Frontend Development', 'description' => 'Topics related to HTML, CSS, JavaScript, and frameworks/libraries like React, Angular, and Vue.js.', 'avatar' => 'fa-html5'],
            ['name' => 'Backend Development', 'description' => 'Server-side languages and frameworks discussions, including PHP (Laravel), Python (Django, Flask), Ruby on Rails, Node.js, etc.', 'avatar' => 'fa-server'],
            ['name' => 'Full Stack Development', 'description' => 'Combining front-end and back-end technologies for complete web application development.', 'avatar' => 'fa-stack-overflow'],
            ['name' => 'Mobile Development', 'description' => 'Development for mobile platforms like iOS (Swift, Objective-C) and Android (Kotlin, Java), as well as cross-platform solutions (React Native, Flutter).', 'avatar' => 'fa-mobile'],
            ['name' => 'Database Systems', 'description' => 'SQL databases (MySQL, PostgreSQL), NoSQL databases (MongoDB, Cassandra), and discussions on database design, optimization, and management.', 'avatar' => 'fa-database'],
            ['name' => 'DevOps and Site Reliability', 'description' => 'Topics on software deployment, automation, cloud services (AWS, Google Cloud, Azure), Docker, Kubernetes, and CI/CD pipelines.', 'avatar' => 'fa-cloud'],
            ['name' => 'UI/UX Design', 'description' => 'For designers in the community to discuss user interface design, user experience, web accessibility, and design tools.', 'avatar' => 'fa-paint-brush'],
            ['name' => 'Career and Learning Resources', 'description' => 'Advice on coding interviews, resume building, portfolio projects, and learning resources.', 'avatar' => 'fa-graduation-cap'],
            ['name' => 'Community Projects and Collaborations', 'description' => 'A space for members to propose, collaborate, and showcase community-driven projects.', 'avatar' => 'fa-users'],
            ['name' => 'Artificial Intelligence', 'description' => 'Discussions on AI, machine learning algorithms, and their applications.', 'avatar' => 'fa-robot'],
            ['name' => 'Cybersecurity', 'description' => 'Exploring security practices, ethical hacking, and protecting systems against vulnerabilities.', 'avatar' => 'fa-shield-alt']
        ];

        foreach ($forums as $update) {
            DB::table('forums')
                ->where('name', $update['name'])
                ->update(['avatar' => $update['avatar']]);
        }
    }
}
