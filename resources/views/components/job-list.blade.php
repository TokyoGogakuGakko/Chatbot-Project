<div x-data="joblist">
    <template x-for="job in jobs" :key="job.id">
        <div
            class="entry cursor-pointer transform hover:scale-105 duration-300 transition-transform bg-white mb-4 rounded p-4 flex shadow-md"
            :class="{'border-l-4 border-green-500' : selectedJobId == job.id}"
            @click="window.location = '{{route('chat')}}?jobId=' + job.id"
        >
            <div class="flex-2">
                <div class="w-12 h-12 relative">
                    <img class="w-12 h-12 rounded-full mx-auto" :src="job.logo" :alt="job.name" />
                    <span
                        class="absolute w-4 h-4 rounded-full right-0 bottom-0 border-2 border-white"
                        :class="{'bg-gray-400' : selectedJobId != job.id, 'bg-green-500' : selectedJobId == job.id}"
                    ></span>
                </div>
            </div>
            <div class="flex-1 px-2">
                <div class="truncate w-32">
                    <span class="text-gray-800" x-text="job.name"></span>
                </div>
                <div>
                    <small class="text-gray-600 line-clamp-1" x-text="job.description"></small>
                </div>
            </div>
            <div class="flex-2 text-right">
                <div><small class="text-gray-500">15 April</small></div>
            </div>
        </div>
    </template>
</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('joblist', () => ({
                jobs: [],
                selectedJobId: @js($selectedJobId),
                init() {
                    this.jobs = [
                        {
                            id: 1,
                            name: 'Senior PHP Developer',
                            description: `
ABOUT SMILE
Smile is a national digital health company with almost 20 years in the industry, comprising 5 divisions including the National Dental Network, Health Fund Partnerships, Projects & Investments plus more recently, Retail Dental Cover and Corporate Dental Cover.
Smile is committed to revolutionizing quality healthcare accessibility and affordability for the people of Australia. Smile is the top-rated dental cover in the country, offering Retail Dental Cover to the public and Corporate Dental Cover to companies and their teams across Australia. Smile has been operating successfully with a globally distributed team since 2017.
About the Team:
The newest team member in our company joined 3 years ago, so we invest and retain our team of high achievers.
Most of our team works from the Brisbane, Australia time zone with at least a 4-hour overlap.
100% remote teams from almost every continent (Oceania, Europe, North America & Asia)!
The Role
ROLE OBJECTIVES:
We are seeking a talented and experienced Senior PHP Full Stack Laravel Development Lead to join our team. This role will be reporting to the Head of IT and will be a part of the Retail Dental Cover & Corporate Dental Cover Divisions. This role offers a unique opportunity for passionate individuals who excel in small team settings and are eager to take ownership of their work. The ideal candidate will have a strong background in PHP development with a focus on Laravel framework.
This role will be responsible for leading projects, architecting and developing new features, and ensuring the scalability and performance of our web applications as the business expands. The position will have a commitment of 40 hours per week with at least 6 hours of crossover b/w 8 am-5 pm GMT+10 (Brisbane, Australia).
KEY PERFORMANCE INDICATORS: * Code Quality: Measure code quality metrics such as code reviews, code coverage, and static code analysis results.
Delivery Time: Track the time to deliver features or bug fixes from initial implementation to deployment.
Customer Satisfaction: Monitoring of customer feedback related to the quality and performance of software products.
API Performance: Measure the performance and reliability of the REST API, including response times and error rates.
System Uptime: Track the uptime of hosting infrastructure and systems, ensuring they meet uptime targets.
Innovation Impact: Evaluate the impact of adopting innovative technologies on development efficiency and team productivity.
Compliance Adherence: Ensure adherence to legal norms and regulations related to data security and privacy throughout all project executions.
KEY RESPONSIBILITIES: * Develop new features, fix bugs, and manage hosting infrastructure for our member and partner portals.
Write clean, efficient code with high test coverage using the PHP Laravel framework
Comprehensively document/comment on code for readability and future modification.
Manage git repositories, flows, and code releases in collaboration with other team members and external vendors.
Manage PostgreSQL databases to create and run data queries and reports.
Create, update, document, and manage a REST API for use in other applications and integrations with high availability.
Collaborate on both front-end and back-end development to optimize software for Google SEO, CRO, PPC, and pass or exceed Google Core Web Vitals assessments.
Identifying new technologies, platforms, and tools that can increase the efficiency of development and team management.
Participate in long-term planning activities such as product roadmaps, backlog estimation, prioritisation, and strategy.
Develop and execute secure and effective data procedures.
Ensure data is handled in line with security best practices and Smile privacy expectations.
Leverage cutting-edge technologies, including AI, to optimize your time and productivity, incorporating AI tools and techniques into the workflow to enhance efficiency and effectiveness across all aspects of our technology stack.
Engage closely with all stakeholders to collaboratively outline project requirements and deliverables, ensuring they are tailored to be both personable and effectively communicated.
Provide technical leadership and expertise on Laravel development best practices, design and emerging technologies
Troubleshoots technical issues and provides solutions to complex problems that may arise during development
Optimize application performance by identifying and addressing bottlenecks, implementing caching strategies, and improving code efficiency
Ideal Profile
REQUIREMENTS
This FULL-TIME ROLE will only suit someone who also meets the following requirements: * Has a passion for excelling in all they do, and this is evidenced by excellent references.
At least 8-10 years of experience with PHP development, and is specifically experienced in the Laravel framework.
PostgreSQL, Gulp, Composer, npm, Pug, Blade, JavaScript, CSS, JQuery, HTML, Git/Github (repos, commits, branching, pull requests, merging etc)
Hands-on experience with SQL schema design, SOLID principles and REST API design.
Software testing experience using tools like PHPUnit.
Experience managing multiple versions, deployments, and customizations of PHP software and API simultaneously.
Extensive experience designing, initializing, and deploying dev, staging, and production servers for the team’s code to run on.
Proven ability to plan and manage schedules, technical documentation, and code repositories.
Has excellent spoken & written English.
Has their tech and office set up conducive to fast, focused, and productive remote work (e.g. high spec computer, monitors, internet over 50Mbps or more, backup solutions, etc.)
PERKS & BENEFITS
Join Smile, where there's a culture of excellence and remote work that thrives! You have the opportunity to make a positive and sustainable impact on people's lives every day and throughout the country.
Smile is an incredibly stable company with 20 years of industry experience, yet is still known for its nimble and innovative approach.
Collaborate with a dedicated and talented team who are also friendly, supportive, trustworthy, enduring, and inspiring. You'll always feel connected and empowered whether it's through virtual meetings or shared documents.
We champion independent ownership amongst effective team members, empowering you to take initiative, make decisions, and drive projects forward with confidence.
Let's talk about rewards! Exceptional and successful applicants will earn beyond local market standards with opportunities to take on more responsibilities and challenges while enjoying the convenience of remote work.
For those local to our headquarters, enjoy a vibrant city workspace with plenty of natural light and scenic river views. Amenities like cafes, bars, yoga studios, and 24-hour gyms are at your fingertips.
Our remote team enjoys a top-of-the-line technology set-up and a positive work environment conducive to productivity. Our remote work approach ensures that Smile achieves its goals and you excel, personally and professionally.
Smile is the ultimate package. Join us for a challenging mission, exceptional team, inspiring culture, opportunity to impact, impressive rewards, remote work, and an exciting future!
What's on Offer?
Opportunity to make a positive impact
Work within a company with a solid track record of success
Great work environment
                            `,
                            categories: ["PHP", "Laravel", "Full Stack"],
                            logo: 'https://hotjobs.bdjobs.com/logos/sentrysecnew48.jpg'
                        },
                        {
                            id: 2,
                            name: "Executive Chef - Expat",
                            description: `
Job Description:
Job Number 24098783
Job Category Food and Beverage & Culinary
Location Renaissance Dhaka Gulshan Hotel, 78 Gulshan Avenue, Dhaka, Bangladesh, Bangladesh
Schedule Full-Time
Located Remotely? N
Relocation? N
Position Type Management
JOB SUMMARY
Accountable for overall success of the daily kitchen operations. Exhibits culinary talents by personally performing tasks while leading the staff and managing all food related functions. Works to continually improve guest and employee satisfaction while maximizing the financial performance in all areas of responsibility. Supervises all kitchen areas to ensure a consistent, high quality product is produced. Responsible for guiding and developing staff including direct reports. Must ensure sanitation and food standards are achieved. Areas of responsibility comprise overseeing all food preparation areas (e.g., banquets, room service, restaurants, bar/lounge and employee cafeteria) and all support areas (e.g., dish room and purchasing).
CANDIDATE PROFILE
Education and Experience
High school diploma or GED; 6 years experience in the culinary, food and beverage, or related professional area.
OR
2-year degree from an accredited university in Culinary Arts, Hotel and Restaurant Management, or related major; 4 years experience in the culinary, food and beverage, or related professional area.
CORE WORK ACTIVITIES
Leading Kitchen Operations for Property
Leads kitchen management team.
Provides direction for all day-to-day operations.
Understands employee positions well enough to perform duties in employees' absence or determine appropriate replacement to fill gaps.
Provides guidance and direction to subordinates, including setting performance standards and monitoring performance.
Utilizes interpersonal and communication skills to lead, influence, and encourage others; advocates sound financial/business decision making; demonstrates honesty/integrity; leads by example.
Encourages and builds mutual trust, respect, and cooperation among team members.
Serving as a role model to demonstrate appropriate behaviors.
Ensures property policies are administered fairly and consistently.
Reviews staffing levels to ensure that guest service, operational needs and financial objectives are met.
Establishes and maintains open, collaborative relationships with employees and ensures employees do the same within the team.
Solicits employee feedback, utilizes an "open door" policy and reviews employee satisfaction results to identify and address employee problems or concerns.
Supervises and coordinates activities of cooks and workers engaged in food preparation.
Demonstrate new cooking techniques and equipment to staff.
Setting and Maintaining Goals for Culinary Function and Activities
Develops and implements guidelines and control procedures for purchasing and receiving areas.
Establishes goals including performance goals, budget goals, team goals, etc.
Communicates the importance of safety procedures, detailing procedure codes, ensuring employee understanding of safety codes, monitoring processes and procedures related to safety.
Manages department controllable expenses including food cost, supplies, uniforms and equipment.
Participates in the budgeting process for areas of responsibility.
Knows and implements the brand's safety standards.
Ensuring Culinary Standards and Responsibilities are Met
Provides direction for menu development.
Monitors the quality of raw and cooked food products to ensure that standards are met.
Determines how food should be presented, and create decorative food displays.
Recognizes superior quality products, presentations and flavor.
Ensures compliance with food handling and sanitation standards.
Follows proper handling and right temperature of all food products.
Ensures employees maintain required food handling and sanitation certifications.
Maintains purchasing, receiving and food storage standards.
Prepares and cooks foods of all types, either on a regular basis or for special guests or functions.
Ensuring Exceptional Customer Service
Provides and supports service behaviors that are above and beyond for customer satisfaction and retention.
Improves service by communicating and assisting individuals to understand guest needs, providing guidance, feedback, and individual coaching when needed.
Manages day-to-day operations, ensuring the quality, standards and meeting the expectations of the customers on a daily basis.
Displays leadership in guest hospitality, exemplifies excellent customer service and creates a positive atmosphere for guest relations.
Interacts with guests to obtain feedback on product quality and service levels.
Responds to and handles guest problems and complaints.
Empowers employees to provide excellent customer service. Establishes guidelines so employees understand expectations and parameters. Ensures employees receive on-going training to understand guest expectations.
Reviews comment cards, guest satisfaction results and other data to identify areas of improvement.
Managing and Conducting Human Resource Activities
Identifies the developmental needs of others and coaching, mentoring, or otherwise helping others to improve their knowledge or skills.
Ensures employees are treated fairly and equitably.
Trains kitchen associates on the fundamentals of good cooking and excellent plate presentations.
Administers the performance appraisal process for direct report managers.
Interacts with the Banquet Chef and Catering department on training regarding food knowledge and menu composition.
Observes service behaviors of employees and provides feedback to individuals and or managers.
Manages employee progressive discipline procedures for areas of responsibility.
Ensures disciplinary procedures and documentation are completed according to Standard and Local Operating Procedures (SOPs and LSOPs) and supports the Peer Review Process.
Additional Responsibilities
Provides information to executive teams, managers and supervisors, co-workers, and subordinates by telephone, in written form, e-mail, or in person.
Analyzes information and evaluating results to choose the best solution and solve problems.
Marriott International is an equal opportunity employer. We believe in hiring a diverse workforce and sustaining an inclusive, people-first culture. We are committed to non-discrimination on any protected basis, such as disability and veteran status, or any other basis covered under applicable law.
At Renaissance Hotels, we believe in helping our guests experience the DNA of the neighborhoods they are visiting. Our guests come to discover and uncover the unexpected, to dive into a new culture, or simply to make the most of a free evening. They see business travel as an adventure because they see all travel as an adventure. Where others may settle for the usual, our guests see a chance to bring home a great story. And so do we. We're looking for fellow spontaneous explorers to join our team to bring the spirit of the neighborhood to our guests. If this sounds like you, we invite you to discover career opportunities with Renaissance Hotels. In joining Renaissance Hotels, you join a portfolio of brands with Marriott International. Be where you can do your best work,​ begin your purpose, belong to an amazing global​ team, and become the best version of you.
                            `,
                            categories: ["Food", "Culinary", 'Management'],
                            logo: 'https://hotjobs.bdjobs.com/logos/sspower300.png'
                        }
                    ];
                },
            }))
        })
    </script>
@endpush
