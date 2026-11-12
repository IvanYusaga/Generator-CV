<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CVController extends Controller
{
    public function index()
    {
        $cv = [
            'name' => 'CHASETYO IVAN YUSAGA',

            'contact' => [
                'phone' => '+62812-5952-3407',
                'email' => 'ivanyusagaz@gmail.com',
                'linkedin' => 'www.linkedin.com/in/chasetyoivanyusaga/',
                'address' => 'Surabaya, Jawa Timur, Indonesia',
            ],

            'summary' => 'Fresh graduate in Informatics from Universitas Pembangunan Nasional "Veteran" Jawa Timur with a GPA of 3.85/4.00 and experience in IT application development. Possess foundational knowledge of computer networking, TCP/IP, IP addressing, subnetting, MikroTik, Linux, and Windows through technical training and academic experience. Also experienced in database management and web application development. Interested in supporting IT operations, maintaining computer systems and network infrastructure, and assisting with technical issues. A fast learner with strong attention to detail and a willingness to work collaboratively.',

            'educations' => [
                [
                    'institution' => 'Universitas Pembangunan Nasional "Veteran" Jawa Timur',
                    'degree' => "Bachelor's Degree in Informatics (IPK : 3.85 / 4.00)",
                    'period' => '2022 - 2026',
                ],
                [
                    'institution' => 'SMA Negeri 3 Surabaya',
                    'degree' => null,
                    'period' => '2019 - 2022',
                ],
            ],

            'experiences' => [
                [
                    'position' => 'Backend Developer Intern',
                    'company' => 'PT IGS Indonesia Groups',
                    'period' => 'February 2025 - July 2025',
                    'descriptions' => [
                        'Developed a web-based thesis registration and graduation system using Node.js and Express.js, supporting the registration process and application functionality.',
                        'Built and integrated RESTful APIs and managed application data using MySQL to support reliable data processing and system integration.',
                    ],
                ],
            ],

            'trainings' => [
                [
                    'name' => 'Training Cisco CCNA 200-301',
                    'organization' => 'ID-Networker',
                    'period' => 'October 2026',
                    'descriptions' => [
                        'Completed offline training covering Network Fundamentals, Network Access, IP Connectivity, IP Services, Security Fundamentals, and Automation and Programmability',
                    ],
                ],
                [
                    'name' => 'IT Fullstack Web-Developer',
                    'organization' => 'Studi Independent Rakamin',
                    'period' => 'December 2024',
                    'descriptions' => [
                        'Completed web development training and developed a web-based medication reminder application using Laravel as a final project.',
                    ],
                ],
            ],

            'projects' => [
                [
                    'name' => 'Thesis and Internship Title Submission System (JUSTIKA)',
                    'period' => 'May 2026',
                    'role' => 'Academic Project',
                    'descriptions' => [
                        'Developed an internship and thesis title submission system using Laravel and JavaScript.',
                        'Integrated BM25, SBERT, and Aho-Corasick for intelligent title search and recommendations.',
                    ],
                ],
                [
                    'name' => 'Thesis Registration and Graduation System (U-YUS)',
                    'period' => 'July 2025',
                    'role' => 'Fullstack Developer Intern at PT. IGS Indonesia Groups',
                    'descriptions' => [
                        'Developed and maintained responsive frontend features using React.',
                        'Built and integrated RESTful APIs using Node.js and Express.js, utilizing MySQL for data management.',
                    ],
                ],
                [
                    'name' => 'Medication Reminder System (Medipulse)',
                    'period' => 'December 2024',
                    'role' => 'Independent Study Program at Rakamin Academy Batch 7',
                    'descriptions' => [
                        'Developed a medication reminder web application using Laravel Framework.',
                        'Implemented medication scheduling, reminders, and tracking features.',
                    ],
                ],
            ],

            'certifications' => [
                [
                    'name' => 'Mikrotik Dasar',
                    'organization' => 'ID-Networker',
                    'period' => 'October 2026',
                ],
                [
                    'name' => 'Jaringan Dasar',
                    'organization' => 'ID-Networker',
                    'period' => 'October 2026',
                ],
            ],

            'technical_skills' => [
                [
                    'category' => 'Networking Fundamentals',
                    'skills' => 'TCP/IP, OSI Model, IP Addressing, Subnetting, Network Fundamentals, MikroTik Basics',
                ],
                [
                    'category' => 'Operating Systems',
                    'skills' => 'Linux, Windows',
                ],
                [
                    'category' => 'Database Management',
                    'skills' => 'MySQL, PostgreSQL, MongoDB',
                ],
                [
                    'category' => 'Programming & Web Development',
                    'skills' => 'PHP, Laravel, JavaScript, Node.js, Express.js, React.js, RESTful API',
                ],
            ],

            'soft_skills' => [
                'Communication',
                'Teamwork and Collaboration',
                'Problem Solving',
                'Attention to Detail',
                'Initiative',
                'Integrity',
            ],
        ];

        return view('cv.preview', compact('cv'));
    }
}
