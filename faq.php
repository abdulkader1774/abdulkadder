<?php
require_once 'config.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;700&display=swap" rel="stylesheet">
    <!-- in your <head> -->
<link href="https://banglawebfonts.pages.dev/css/solaiman-lipi.css" rel="stylesheet">


    <style>
    body {
        background-color: #f8f9fa;
    }

    *{
                font-family: "SolaimanLipi", "Noto Sans Bengali", sans-serif;

    }

    .registration-container {
        background-color: white;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
        color: #3f51b5;
    }

    .header h2 {
        font-weight: 700;
    }

    .form-section {
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .form-section-title {
        color: #3f51b5;
        margin-bottom: 20px;
        font-weight: 600;
        display: flex;
        align-items: center;
    }

    .form-section-title i {
        margin-right: 10px;
        font-size: 1.2rem;
    }

    .password-toggle {
        cursor: pointer;
        position: absolute;
        right: 15px;
        top: 38px;
        color: #6c757d;
    }

    .select-icon {
        position: relative;
    }

    .select-icon:after {
        content: "▼";
        font-size: 12px;
        position: absolute;
        right: 15px;
        top: 42px;
        color: #6c757d;
        pointer-events: none;
    }
    </style>
</head>

<body>
    <?php include"nav.php" ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="registration-container">
                    <div class="header">
                        <h2><i class=""></i> FAQ - Friquently Ask Question</h2>
                        <p class="text-muted">Please fill in all the required information</p>
                    </div>

                    <div class="container">
                        <ul type="none">
                            <div class="row mb-4">
                                <li class="fw-bold">
                                    বিডিআইকিউপিসি ২০২৫ কী?
                                </li>
                                <li class="text-secondary">
                                    বিডিআইকিউপিসি (BDIQPC) ২০২৫ হলো বাংলাদেশ আইটি কুইজ ও প্রোগ্রামিং প্রতিযোগিতা
                                    (Bangladesh IT Quiz and Programming Contest)। এটি মাধ্যমিক ও উচ্চ মাধ্যমিক পর্যায়ের
                                    শিক্ষার্থীদের জন্য আয়োজিত একটি আইসিটি কুইজ ও প্রোগ্রামিং প্রতিযোগিতা। </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    কারা অংশ নিতে পারবে?
                                </li>
                                <li class="text-secondary">
                                    দেশের সকল স্কুল, কলেজ, মাদ্রাসা ও কারিগরি শিক্ষাবোর্ডের অন্তর্ভুক্ত ৬ষ্ঠ থেকে ১২শ
                                    শ্রেণির সকল শিক্ষার্থী এই প্রতিযোগিতায় অংশগ্রহণ করতে পারবে।

                                    <ul>
                                        <li>সাধারণ শিক্ষাবোর্ড: এইচএসসি ২০২৬ পরীক্ষার্থী বা সমমানের শিক্ষার্থী পর্যন্ত।
                                        </li>
                                        <li>মাদ্রাসা শিক্ষা বোর্ড: আলিম ২০২৬ পরীক্ষার্থী বা সমমানের শিক্ষার্থী পর্যন্ত।
                                        </li>
                                        <li>কারিগরি শিক্ষা বোর্ড: পলিটেকনিক ৪র্থ সেমিস্টার বা সমমানের শিক্ষার্থী
                                            পর্যন্ত। </li>
                                        <li>ব্রিটিশ কারিকুলাম: ২০২৬ সালের A2 পরীক্ষার্থী বা সমমানের শিক্ষার্থী পর্যন্ত।
                                        </li>
                                    </ul>
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    প্রতিযোগিতার কয়টি বিভাগ থাকবে?
                                </li>
                                <li class="text-secondary">
                                    প্রতিযোগিতায় মোট দুইটি বিভাগ থাকবে:
                                    <ul>
                                        <li>প্রোগ্রামিং প্রতিযোগিতা - সমস্যা সমাধান। </li>
                                        <li>আইসিটি কুইজ প্রতিযোগিতা - বস্তুনির্বাচনী।</li>
                                    </ul>
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    কীভাবে প্রতিযোগিতার জন্য নিবন্ধন করতে হবে?
                                </li>
                                <li class="text-secondary">
                                    bdiqpc.com এর ওয়েবসাইটে গিয়ে, নিবন্ধন এ ক্লিক করে ফর্ম পূরণ করতে হবে। নিবন্ধন করার
                                    সময় কুইজ না প্রোগ্রামিং তা নির্বাচন করতে হবে।
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    নিবন্ধনের জন্য কত টাকা ফি রয়েছে?
                                </li>
                                <li class="text-secondary">
                                    প্রতিযোগিতার বিভাগ অনুযায়ী নিবন্ধন ফি প্রদান করতে হবে।
                                    <ul>
                                        <li>প্রোগ্রামিং প্রতিযোগিতা- ২০০ টাকা </li>
                                        <li>আইসিটি কুইজ প্রতিযোগিতা- ১৫০ টাকা </li>
                                    </ul>
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    নিবন্ধনের জন্য কীভাবে ফি পরিশোধ করতে হবে?
                                </li>
                                <li class="text-secondary">
                                    নিবন্ধনের পেজে একটি বিকাশ নম্বর দেওয়া থাকবে। এ নম্বরে ফি প্রেরণ করতে হবে। ফি
                                    পরিশোধের পর ট্রানজেকশান আইডি নিবন্ধন পাতায় দিতে হবে। নইলে নিবন্ধন হবে না।
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    প্রতিযোগিতায় শ্রেণীবিভাগ কেমন?
                                </li>
                                <li class="text-secondary">
                                    কুইজ এবং প্রোগ্রামিং প্রতিযোগিতা দুটোতেই দুটি ক্যাটাগরি থাকবে।
                                    <ul>
                                        <li>প্রোগ্রামিং : জুনিয়র (৬ষ্ঠ-৯ম) এবং সিনিয়র (১০ম- ১২শ) </li>
                                        <li>কুইজ :- জুনিয়র (৬ষ্ঠ-৮ম) এবং সিনিয়র (৯ম- SSC, ২০২৫)</li>
                                    </ul>
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    প্রতিযোগিতা কয়টি ধাপে অনুষ্ঠিত হবে?
                                </li>
                                <li class="text-secondary">
                                    প্রতিযোগিতা মোট দুটি ধাপে অনুষ্ঠিত হবে: প্রথমে বাছাই পর্ব এবং এরপর ফাইনাল পর্ব।
                                    সম্পূর্ণ প্রতিযোগিতা অনলাইনেই অনুষ্ঠিত হবে।
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    প্রোগ্রামিং প্রতিযোগিতার ধরণ কেমন?
                                </li>
                                <li class="text-secondary">
                                    প্রোগ্রামিং প্রতিযোগিতা মূলত সমস্যা সমাধান নিয়ে হবে। জাতীয় পর্বে ১২টি সমস্যা দেওয়া
                                    হবে এবং এর জন্য ৪ ঘণ্টা সময় থাকবে।
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    প্রোগ্রামিং প্রতিযোগিতায় কোন কোন ভাষা ব্যবহার করা যাবে?
                                </li>
                                <li class="text-secondary">
                                    প্রোগ্রামিং প্রতিযোগিতায় সি, সি++, পাইথন, জাভা ব্যবহার করা যাবে।
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    কুইজ প্রতিযোগিতার ধরণ কেমন?
                                </li>
                                <li class="text-secondary">
                                    কুইজ প্রতিযোগিতা এমসিকিউ ফরম্যাটে অনুষ্ঠিত হবে যেখানে প্রতিটি প্রশ্নে ৪টি করে অপশন
                                    থাকবে। বাছাই পর্ব ও জাতীয় পর্বে মোট ১০০টি প্রশ্ন থাকবে। বাছাই পর্বে সময় ৫০ মিনিট এবং
                                    জাতীয় পর্বে সময় ৩০-৪০ মিনিট।
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    প্রতিযোগিতার জন্য কীভাবে প্রস্তুতি নেব?
                                </li>
                                <li class="text-secondary">
                                    নিবন্ধন সম্পন্ন করার পর আপনার প্রোফাইলে প্রয়োজনীয় নোট, ব্লগ, রিসোর্স ইত্যাদি দেওয়া
                                    হবে। কুইজ বা প্রোগ্রামিং, সবাই নিজের সুবিধামত সেগুলো ব্যবহার করতে পারবে।
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    প্রতিযোগিতা কোথায় অনুষ্ঠিত হবে?
                                </li>
                                <li class="text-secondary">
                                    প্রোগ্রামিং ও কুইজ প্রতিযোগিতা দুটোই অনলাইনে অনুষ্ঠিত হবে।
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    প্রতিযোগিতার জন্য কী পুরষ্কার দেওয়া হবে?
                                </li>
                                <li class="text-secondary">
                                    প্রতিযোগিতায় প্রত্যেক অংশগ্রহণকারীই পুরষ্কার হিসেবে পাবে "Participation
                                    Certificate"। প্রতিটি রাউন্ডে বা পর্বে বিজয়ীরা পাবে "Achievement Certificate"।
                                    ফাইনাল রাউন্ডে, বিজয়ীরা অর্থমূল্য পাবে। সকল পুরষ্কার অনলাইনেই প্রদান করা হবে।
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    প্রতিযোগিতার ফলাফল কীভাবে জানানো হবে?
                                </li>
                                <li class="text-secondary">
                                    প্রতিযোগিতার ফলাফল আমাদের অফিশিয়াল পেজেই প্রকাশ করা হবে। এছাড়া আমাদের ফেসবুক পেজেও
                                    ফলাফল প্রকাশ করা হবে।
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    প্রতিযোগিতা সম্পর্কিত কোনো জিজ্ঞাসা, প্রশ্ন বা মতামত থাকলে কীভাবে বা কার সাথে
                                    যোগাযোগ করতে হবে?
                                </li>
                                <li class="text-secondary">
                                    প্রত্যেকে তার নিজ নিজ প্রোফাইলে "যোগাযোগ" অপশনে গিয়ে যেকোনো প্রশ্ন বা মতামত জানাতে
                                    পারবে। এছাড়াও আমাদের অফিশিয়াল ফেসবুক পেজে, কিংবা হোয়াটসঅ্যাপ গ্রুপে যেকোনো বিষয়ে
                                    সাহায্য পাওয়া যাবে।
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    কোনো প্রতিযোগি কী দুটো প্রতিযোগিতায়ই অংশগ্রহণ করতে পারবে?
                                </li>
                                <li class="text-secondary">
                                    না, একজন প্রতিযোগি প্রোগ্রামিং না হয় কুইজ বা যেকোনো একটি প্রতিযোগিতায় অংশ নিতে
                                    পারবে। কেউ দুটোটেই অংশ নিতে পারবে না।
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    যারা নতুন, কখনো প্রোগ্রামিং করে নিই বা তারা কী এই প্রতিযোগিতায় অংশ নিতে পারবে?
                                </li>
                                <li class="text-secondary">
                                    হ্যাঁ, যেকেউই এই প্রতিযোগিতায় অংশ নিতে পারবে। যারা নতুন তারা ব্লগ গুলো পড়ে দেখতে
                                    পারো। অনুশীলনীর জন্য সমস্যা দেওয়া থাকবে, সেগুলো সমাধান করতে পারো। নিবন্ধন শেষে
                                    প্রস্তুতির জন্য আমরা অনেক সময় দেব।
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    প্রতিযোগিতায় অংশগ্রহণের জন্য কী কী দক্ষতা লাগবে?
                                </li>
                                <li class="text-secondary">
                                    মোটামুটি আইসিটি বা প্রোগ্রামিং বিষয়ে ধারণা থাকলেই চলবে। না থাকলেও সমস্যা নেই। আমরা
                                    আপনাদের পাশে আছি। প্রোফাইলে প্রয়োজনীয় সকল তথ্য দেওয়া থাকবে, যা সকল স্তরের মানুষকে
                                    শিখতে সহারতা করবে।
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    কীভাবে প্রতিযোগিতায় অংশগ্রহণ করব?
                                </li>
                                <li class="text-secondary">
                                    তোমার মোবাইল বা কম্পিউটার কিংবা ল্যাপটা বা ট্যাবে ইন্টারনেট সংযোগের মাধ্যাম
                                    নির্দিষ্ট সময়ে প্রতিযোগিতায় অংশগ্রহন করবে।
                                </li>
                            </div>

                            <div class="row mb-4">
                                <li class="fw-bold">
                                    আমাদের উদ্দেশ্য কী ?
                                </li>
                                <li class="text-secondary">
                                    দেশে স্কুল, কলেজের শিক্ষার্থীদের মাঝে আইসিটি বিষয়ে এবং প্রোগ্রামিংকে জনপ্রিয় করে
                                    তোলাই আমাদের একমাত্র উদ্দেশ্য। শিক্ষার্থীরা যাতে প্রোগ্রামিংয়ে দক্ষ হয়ে ওঠতে পারে
                                    এবং দেশ ও জাতির কল্যানে কাজ করে এটাই আমাদের প্রত্যাশা। তাই যারা আইসিটি বিষয়ে নতুন
                                    তারা যেন একটা ধারনা লাভ করতে পারে তাদের জন্য কুইজ প্রতিযোগিতা এবং যারা কিছুটা জানে
                                    বা দক্ষ তাদের জন্য প্রোগ্রামিং প্রতিযোগিতা।
                                </li>
                            </div>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include"footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>