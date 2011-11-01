<?php exit; ?>
Q2hhbmdlTG9n	42	YW5vbnltb3Vz	127.0.0.1	1081575158	
이 페이지는 TiniWiki의 개발 현황을 정리한 페이지입니다.

! 개발중인 버전

!!!! version 0.1.-1?? ''(2004/04/1x?)''
* 사용자 기능 추가! 'ㅡ')/
* 몇몇 구현되지 않던 엔티티들 구현:
** &amp;Author;, &amp;Author.asis;, &amp;Author.url;
** &amp;cauthor;, &amp;cauthor.asis;, &amp;cauthor.url;
** &amp;user;, &amp;user.asis;, &amp;user.url;
** &amp;Version;, &amp;mTime;, &amp;ctime;
* __plugin: UserPreference version 0.03__
** 첫 릴리즈 -_-

---

{{
''< 0.1.-xx'' | __0.1.-1xx__ | [0.1.-2xx >|ChangeLog/0.1.-2xx]
}}
 // -_-;

!!!! version 0.1.-149 ''(2004/04/10)''
* 허억! 존재하지 않는 페이지를 클릭했을 때 동시 수정으로 표시되는 문제 수정. ''wiki.php만 고치고 wikiengine.php는 안 고쳐서 발생했다. -_-''
* 불필요한 빈 p 태그를 삭제하도록 수정했다. 파싱 속도에는 눈꼽만한 영향 밖에 안 준다.
** \\right 등 정렬 지정자들에서 발생하는 문제도 고쳤다. 아래의 \\right 앞의 빈 줄이 사라졌음을 볼 수 있다. (빈 줄을 일부러 만드려면 공백 하나를 넣어 주면 된다)
* __theme: TiniWikiDefault version 0.12c__
** links1.php와 links2.php에서 존재하는 페이지에 대한 액션을 view가 아닌 edit로 고침.
* __plugin: AllPages version 0.09c__
** 자동 p 태그 삭제를 위한 코드 추가
* __plugin: RecentChanges version 0.05c__
** 위와 마찬가지-_-;;;

!!! version 0.1.-150 ''(2004/04/09)''
\right <span style="color:blue;">참고로 이 정렬 기능의 문제는, 만약 맨 첫 컬럼에 \\right 등이 있을 경우 빈 줄이 나가 버린다는 것이다. 이건 나중에 고치겠다.</span>

* __첫 목표였던 버전에 드디어 도달하였다. 이제 0.1.-130 전까지 거의 모든 기능이 다 들어 갈 것이다. :)__
* edit 액션에서 동시 수정시 경고를 출력하도록 고침. (방법은 wikiX와 비슷하다. 현재 버전과 비교하기 -_-) 이거 하면서 wiki.php에서 까먹고 안 넣은 $pagedata 변수들도 다 넣어 줬다 :)
* 표에서 td 태그에 속성을 넣는 방법을 제공한다. ||{width="300"}과 같이 하면 된다. (XHTML화를 안 하므로 조심해야 한다)
* 줄 중간에 \\left, \\right, \\center를 입력하면 그 줄부터 다음 정렬 지시자 혹은 p 태그 끝까지 정렬을 적용한다. 무시는 \\\\(left|right|center)로 한다.
* 버그 잡이
** 주석을 위한 부분이 syntax_(un)?escape에 구현되어 있지 않아서 \//나 \/*...*/가 들어 간 링크의 존재 여부가 제대로 판단되지 않았다. 고쳤다.
** 꽤액. 페이지 이름 출력할 때 실수로 syntax_unescape에서 한 번 처리한 다음에 syntax_escape_special에서 다시 한 번 처리하는 바람에 [\\]와 같은 링크가 제대로 처리되지 않았다. 역시 고쳤다.

!!!! version 0.1.-151
* 표 기능에 산재한 버그를 무진장 잡았다. T_T
** 실수로 p 태그를 생략. 고로 XHTML에 맞지 않는다. -_-;; 부랴부랴 고쳤다.
** 안에서 td 태그를 넣을 경우 깨진다. 이 버그는 매우 고치기가 힘든 고로 제껴 버리고, (구현했다가 tr때문에 포기했다) 가급적이면 표 문법 안에 td/tr 등을 넣지 말 것을 권한다.
** 마지막 줄에 있는 표가 제대로 안 닫히는 버그 고침
* 표 안에서 정렬이 가능하도록 고쳤다. colspan, rowspan 뒤에다가 <, ^, >를 붙이면 된다. (조만간 p 태그에 대한 것도 마련할 예정)
* __theme: TiniWikiDefault version 0.12b__
** td 태그 안의 p 태그가 보기 안 좋게 출력되길래 -_- 고쳤다.

!!!! version 0.1.-152 ''(2004/04/07)''
* 표 기능 추가! syntax_linear 함수를 거의 쑤셔 대고 구조를 바꿔서 해결했다. (의외로 쉽더군... 쿨럭)
** ''앞으로: 표에 속성을 지정하는 기능 추가 예정.''
* em 태그의 버그 수정.. \\\{{{...}}}와 같이 무시하는 경우 제대로 처리되지 않았다.
* __theme: TiniWikiDefault version 0.12a__
** links1.php/links2.php에서 없는 페이지는 붉게 표시하도록 바꿈. (사실은 까먹었던 것이었다. -_-)
** ''(나중에 덧붙임)'' links1.php에서, 현재 페이지가 없는 페이지일 경우 표시하는 메시지를 바꿨다.
** CSS 파일을 정리하고 몇 가지 속성을 바꿈 -_-;
** table을 위한 CSS 정의!
* __plugin: AllPages version 0.09b__
** 페이지 이름의 pagename 클래스를 link 클래스로 바꿈 (통일성을 위함)
* __plugin: RecentChanges version 0.05b__
** 위와 같음;

!!!! version 0.1.-157 ''(2004/04/06)''
* 역링크 기능 추가!!! (links1, links2 액션) ''신나서 버전을 7이나 올렸다. -_-''
** 오버헤드 문제로 ph.*.php, pl.php 파일에서 links_(to|from) 필드가 빠졌다. 귀찮다.
** ''(0.1.-157/BETA30에서 추가)'' 수정 시 링크하는/링크한 페이지가 없는 경우 해당 파일을 삭제한다. 용량 절감을 위함이다 (....)
** 파일 포맷 변경시 data/_adjust.php를 TiniWiki 루트 디렉토리에 놓고 실행할 것.
** ''현재 페이지를 링크하는 "갯수"만 바뀐 경우 감지하지 못 한다. 고칠 지 말 지는 나중에... ;;;''
* goto 액션에서 특수 문자가 들어 간 페이지를 입력할 때 제대로 된 페이지를 찾지 못 하는 버그 수정
* __theme: TiniWikiDefault version 0.12__
** links1.php와 links2.php 파일 추가
** 테마 약간 고쳤음 ~_~

!!!! version 0.1.-164 ''(2004/03/29)''
* 어처구니 없는 실수 몇 가지 수정
** 인터위키 링크에서 \\나 \:를 제대로 파싱하지 못 하는(..) 문제 해결
** 소스 코드를 조금 정비. (링크 관련 버그 거의 다 잡혔다;)
* wikiengine.php에서 \`의 처리 부분을 약간 고침. (preg_replace 한 개를 str_replace 두 개로...)
* ''버그(?) 발견: 인터위키는 \[...] 안에서만 사용 가능하다. 젠장! 그러나 아직 고칠 생각 없음. (너무 힘들다고...)''

!!!! version 0.1.-165 ''(2004/03/28)''
* __''헛소리''__
** ''숙제의 압박에 시달렸다. 지금은 좀 사정이 나은 것 같다.''
** ''version 0.1.-150이 눈 앞에 보인다. 이제 슬슬 귀찮거나 힘들어서 안 넣은 기능을 모두 추가할 때인데 시간이 없군...''
* 정의 목록 추가. 정의 목록의 특성으로 발생할 수 있는 버그를 찾은 건 다 고침. -_-;
* 목록 파싱 부분에 존재하는 몇 가지 버그 해결
* pre 태그에서 \{{...}} 뿐만 아니라 \{{{...}}}와 같이 갯수만 맞으면 다 되도록 고침 (헷갈려서...-_-) em 태그에는 적용되지 않는다. (귀찮다)

!!!! version 0.1.-167
* listing에서 그 깊이가 한 번에 2 이상 올라 갈 때 출력하는 태그를 약간 다르게 고침. (-_-;) 가급적이면 이 기능은 사용하지 않을 것을 권한다.
* 쓸 데 없는 코드 몇 줄 삭제
* __theme: TiniWikiDefault version 0.11e__
** blockquote에 해당하는 CSS 추가

!!!! version 0.1.-168 ''(2004/03/15)''
* 엔티티 추가:
** &amp;tiniwiki.name;, &amp;tiniwiki.author;
** &amp;path;, &amp;path.host;, &amp;path.root;, &amp;path.theme;
** &amp;npage;, &amp;npages;, &amp;nPages;
** &amp;pagename;, &amp;PageName;, &amp;pagename.asis;, &amp;pagename.url;
** &amp;author;, &amp;author.asis;, &amp;author.url;
** &amp;userip;, &amp;version;, &amp;mtime;
** &amp;yyyy;, &amp;mm;, &amp;m;, &amp;dd;, &amp;d;, &amp;hh;, &amp;h;, &amp;nn;, &amp;ss;, &amp;today;, &amp;now;
* 주석 기능 추가. \//와 \/*...*/를 사용한다.
* 몇 가지 어처구니 없는 버그 수정.
** listing이 여러 줄에 걸쳐서 되지 않는 버그
** pre 태그가 blockquote 안에서 제대로 들어 가지 않는 버그
** listing/blockquote 안에서 block 태그를 쓸 때 제대로 닫히지 않던 버그
** 그 외 몇가지...

!!!!! version 0.1.-168/BETA4 ''(2004/03/14)''
* __plugin: AllPages version 0.09a__
** /와 같은 특수문자를 포함한 페이지가 제대로 링크가 안 되는 문제 해결 (-_-;)
* __plugin: RecentChanges version 0.05a__
** 위와 같음(..)

!!!!! version 0.1.-168/BETA3
* pre 태그 구현. XHTML 등 여러 문제로 pre 태그 안에서 block 태그는 못 쓰게 되어 있다. (...)
* tt 태그는 항상 한 줄 안에서만 가능하도록 고침.
* 쓸데 없는 코드(syntax_pre 같은-_-) 정리하고 코드 약간 간소화함.

!!!!! version 0.1.-168/ALPHA17 ''(2004/03/13)''
* blockquote 태그, 목록 파싱 기능이 추가됨.
* heading과 hr 태그 등등의 몇몇 처리와 목록 파싱 부분이 syntax_linear 함수로 통합. 이 부분은 단순 루프기 때문에 속도가 아마 10-20% 정도 향상되리라 기대한다.
* 소스를 드디어(..) 분리. ''wiki.php(액션별 처리), wikiengine.php(파싱), wikipage.php(페이지), wikiutil.php(일반함수)'' 아무래도 lib 같은 디렉토리에 몰아 넣는 게 더 나은 것 같기도...
* __theme: TiniWikiDefault version 0.11d__
** ul, ol 태그에 대한 CSS 코드 추가

!!!! version 0.1.-171 ''(2004/03/09)''
* HTML 태그 파싱 기능 추가! -_-; ''XHTML로 자동으로 변환하는 기능이 있으며, 블록 태그가 입력되었을 경우 자동으로 열고 닫는다. 안 닫힌 태그에 대한 처리는 다음 버전에서...''
* &amp;nbsp; 엔티티 추가. -_-

!!!! version 0.1.-172 ''(2004/03/08)''
* diff 액션 구현 'ㅡ')/
* info 액션에서 페이지가 없을 경우 에러가 나는 문제 해결.
* __theme: TiniWikiDefault version 0.11c__
** diff 액션을 위한 페이지 추가;
** 오페라에서 body 태그의 margin이 제대로 설정되지 않는 문제 해결. (user agent 보고 꽁수로 끼워 넣기-_-)

!!!! version 0.1.-176
* edit 액션에 preview 기능 추가! :)
* __theme: TiniWikiDefault version 0.11b__
** MSIE에서 좀 맛이 가서 보이는 것을 수정함. -_-; (사실은 MSIE는 쳐다 보기도 싫다만...)

!!!! version 0.1.-178
* 주소 처리 방법을 조금 바꿨다. \\나 . 등이 들어 가는 (파일처럼 보이는 주소) 페이지들이 에러 안 나고 제대로 동작하게 만들었다.
* toki_url(encode|decode) 함수 추가. %2F를 그대로 넣을 경우 아파치에서 에러가 나는 경우가 있다.
* goto 액션에서 아무 것도 입력 안 되었을 경우 대문으로 가게 고침.

!!!! version 0.1.-179
* 어처구니 없는 실수 고침-_- base64_encode를 안 해 주는 덕분에 pl.php에 페이지 리스트가 계속 쌓이는 문제가 발생했다.

!!!! version 0.1.-180 ''(2004/03/07)''
* pl.php 완벽 구현... 자질구레한 버그 때문에 환장하는 줄 알았다.
* goto 액션 추가. -_-;;;;;;;;
* &amp;tiniwiki.Version; 엔티티 추가. (...)
* pre 태그 안에서 p 태그가 파싱되는(..) 버그 잡음. preg_replace만 쓰려니까 warning이 자꾸 떠서 preg_replace_callback(PHP >=4.0.5) 썼다. 뭐 php3은 대상이 아니니까 상관 없지 :)
* WikiWord를 \`로 escape할 때 $\`와 같이 "WikiWord에 해당되지 않는" 문자가 \` 앞에 있어도 링크가 되는 걸 고침. ($\``WikiWord 이렇게 하면 안 링크된다.)
* link시 페이지가 있는 지 없는 지 확인을 빠르게 하기 위하여 pll.php와 page_exists 함수 추가. 속도가 30~50% 정도 향상된 것 같다.
* __plugin: RecentChanges version 0.05__
** 드디어 추가 'ㅡ')/
* __plugin: AllPages version 0.09__
** 디자인 조금 바꾸고 파일 구조 바뀐 거에 따라 수정.
** 이름 순서대로 정렬해서 출력하도록 했다.
* __theme: TiniWikiDefault version 0.11a__
** edit.php에서 \</p> 빼먹어서 XHTML 1.1에 안 맞는 거 수정. -_-;;
** goto 액션을 위한 폼 추가
** 글꼴 크기를 조정해서 이상하게 나오는 걸 막았다. (17pt가 이상하게 나오더군...)

!!!!! version 0.1.-180/BETA12 ''(2004/03/06)''
* page history 기능 지원. 쩝쩝...
* netlink에서 엄청난 실수를 바로 잡음. a 태그가 두 번 묶이는 경우가 발생할 수 있다.
* 파일 구조를 조금 바꿨다. php가 작동하는 웹 서버에서는 해당 파일을 볼 수 없다. ($``wikiDataEscape 변수에 있는 내용이 처음 헤더에 들어 간다.)
* __plugin: AllPages version 0.08c__
** 파일 구조 바뀐 대로 수정.
* __plugin: WikiEgg version 0.021__
** 이스터 에그랍시고 집어 넣은 테스트용 플러그인.
** (0.02 -> 0.021) \\x04가 두 개 들어 가 있어서 하나가 파싱되지 않고 남는 버그 해결. (MSIE에서는 보이고 Mozilla에선 안 보인다.)
* __theme: TiniWikiDefault version 0.11__
** 스타일 시트를 조금 변경하였다. 제목에 색깔 들어 간다 :)
** 아이콘을 집어 넣었다.
** info.php 추가.

!!!!! version 0.1.-187b
* 파일 구조 확정. 이름 체계 바꾸다.
* __plugin: AllPages version 0.08b__
** 이름 체계 바뀐 거에 맞춰서 프로그램 고치고 플러그인 포맷 조금 바꿈.

!!!! version 0.1.-187 ''(2004/03/03)''
* entity parsing 기능 추가. tiniwiki.version과 세 개의 HTML entity를 집어 넣었다. 무시할 때는 &amp;tiniwiki.version;이나 \&tiniwiki.version; 이렇게 하면 된다 :)

!!!! version 0.1.-189
* 아니다. netlink 안 고쳤다. 고쳐 놓고 보니까 \\가 anchor에 들어 있을 경우의 해결책이 상당히 혼잡스러운데, 나중에 고치자. 귀찮아 죽겠다.

!!!! version 0.1.-190 ''(2004/03/02)''
* bracket link가 한 줄에 둘 이상 있을 때 anchor가 달린 것이 있을 경우 링크가 잘못 해석 되는 문제를 해결. 하는 김에 syntax_link 함수를 확 뒤엎어서 좀 더 빠르고 깔끔하게 고쳤다. link는 이제 끝! 'ㅡ')/
* 테마 기능 추가. (덤으로 모든 태그에 class 추가)
* __theme: TiniWikiDefault version 0.1__
** 첫번째 TiniWiki 테마 :)

!!!! version 0.1.-196 ''(2004/03/01)''
* syntax_parsing 함수 고침. 자동으로 줄 구분 문자 인식해서 그걸로 쭉 밀고(..) 나간다.

!!!! version 0.1.-197
* heading 기능 추가. 아직 목차 기능 구현 안 했다.

!!! version 0.1.-200 ''(2004/02/29)''
* link의 anchor 부분에 존재하는 버그 해결. 진짜로 0.1.-2xx 대의 마지막 버전.
