# Prairie Home Companion

[Prairie Home Companion](https://en.wikipedia.org/wiki/A_Prairie_Home_Companion) was a weekly radio show on NPR that my Dad used to listen to when I was a kid.  I have memories of him in the garage working on stuff and he would always have it on.  The show ran from 1974-2016.

Now discontinued, the show has been subject to [controvery](https://www.mpr.org/stories/2017/11/29/statement-from-minnesota-public-radio-regarding-garrison-keillor-and-a-prairie-home-compa) due to an allegation of inappropriate behavior by the host, and the entire archive of the show was taken down.  This blanket erasure of 40 years of American history was shocking, and the guys at [r/DataHoarder](https://www.reddit.com/r/DataHoarder) have been working to archive the surviving files.

The files from 1981-1995 were at one time available on [Archive.org](https://archive.org/search.php?query=PrairieHomeCompanion%7Ctitle=Archive.org) but have been taken down.  The remaining files, however, still exist on the Minnesota Public Radio webserver.  By knowing the naming convention of the files, I was able to write this script to sequentially download the last 20 years of the show from 1996-2016.

## How To Run

This script will download the mp3 files to the ``storage`` directory.

```
$ git clone git@github.com:swt83/php-phc-downloader.git phc
$ cd phc
$ composer update
$ php run
```

Rerunning the app will auto-skip the files that already exist on your hard drive.  It took me about 24 hours to download the entire archive.  The total filesize was 130 GB.

# Cleaning

I like to nuke the ID3 metadata on the files.

```
$ id3v2 -D */*.mp3
```