<?php

namespace Database\Seeders;

use App\Interfaces\ForumRepositoryInterface;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    protected ForumRepositoryInterface $forumRepository;
    public function __construct(ForumRepositoryInterface $forumRepository) {
        $this->forumRepository = $forumRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $forums = [
            ['name' => 'General Programming', 'description' => 'Discussions on programming fundamentals, logic, algorithms, and best practices.'],
            ['name' => 'Frontend Development', 'description' => 'Topics related to HTML, CSS, JavaScript, and frameworks/libraries like React, Angular, and Vue.js.'],
            ['name' => 'Backend Development', 'description' => 'Server-side languages and frameworks discussions, including PHP (Laravel), Python (Django, Flask), Ruby on Rails, Node.js, etc.'],
            ['name' => 'Full Stack Development', 'description' => 'Combining front-end and back-end technologies for complete web application development.'],
            ['name' => 'Mobile Development', 'description' => 'Development for mobile platforms like iOS (Swift, Objective-C) and Android (Kotlin, Java), as well as cross-platform solutions (React Native, Flutter).'],
            ['name' => 'Database Systems', 'description' => 'SQL databases (MySQL, PostgreSQL), NoSQL databases (MongoDB, Cassandra), and discussions on database design, optimization, and management.'],
            ['name' => 'DevOps and Site Reliability', 'description' => 'Topics on software deployment, automation, cloud services (AWS, Google Cloud, Azure), Docker, Kubernetes, and CI/CD pipelines.'],
            ['name' => 'UI/UX Design', 'description' => 'For designers in the community to discuss user interface design, user experience, web accessibility, and design tools.'],
            ['name' => 'Career and Learning Resources', 'description' => 'Advice on coding interviews, resume building, portfolio projects, and learning resources.'],
            ['name' => 'Community Projects and Collaborations', 'description' => 'A space for members to propose, collaborate, and showcase community-driven projects.'],
            ['name' => 'Artificial Intelligence', 'description' => 'Discussions on AI, machine learning algorithms, and their applications.'],
            ['name' => 'Cybersecurity', 'description' => 'Exploring security practices, ethical hacking, and protecting systems against vulnerabilities.']
        ];

        foreach ($forums as $forum) {
            $this->forumRepository->create($forum);
        }
    }
}
