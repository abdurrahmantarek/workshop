<?php
namespace App\Services;

use App\Repositories\Interfaces\TweetInterface;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\TweetRepository;
use App\Repositories\UserRepository;
use PDF;

class ReportService {

    protected $userRepository;
    protected $tweetRepository;

    public function __construct(UserInterface $userRepository, TweetInterface $tweetRepository)
    {
        $this->userRepository = $userRepository;
        $this->tweetRepository = $tweetRepository;
    }


    public function generatePdf()
    {

        $pdfInfo = $this->pdfInfo();

        return PDF::loadView('reports.pdf-report', $pdfInfo);
    }

    private function pdfInfo()
    {

        return  [
            'usersWithCountedTweets' => $this->userRepository->usersWithCountedTweets(),
            'totalUsers' => $this->userRepository->totalUsers(),
            'totalTweets' => $this->tweetRepository->totalTweets()
        ];
    }

}
