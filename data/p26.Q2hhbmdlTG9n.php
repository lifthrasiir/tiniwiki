<?php exit; ?>
Q2hhbmdlTG9n	26	YW5vbnltb3Vz	127.0.0.1	1079111313	
이 페이지는 TiniWiki의 개발 현황을 정리한 페이지입니다. %%%
아래에 쓰여 있는 버전들은 개발 중이거나 계획 중인 버전이며, 선 아래 버전들은 현재/이전 버전입니다.

!!!! version 0.1.-15x ''(2004/03/??)''
* links_to, links_from 필드를 구현하고 역링크 기능 추가.

!!!! version 0.1.-168 ''(2004/03/1x?)''
* &amp;pagename, &amp;version;, &amp;author; 등등 정보를 나타내기 위한 엔티티 추가 %%%

---

!!!!! version 0.1.-168/BETA3
* pre 태그 구현. XHTML 등 여러 문제로 pre 태그 안에서 block 태그는 못 쓰게 되어 있다. (...)
* tt 태그는 항상 한 줄 안에서만 가능하도록 고침.
* 쓸데 없는 코드(syntax_pre 같은-_-) 정리하고 코드 약간 간소화함.

!!!!! version 0.1.-168/ALPHA17 ''(2004/03/13)''
* blockquote 태그, 목록 파싱 기능이 추가됨.
* heading과 hr 태그 등등의 몇몇 처리와 목록 파싱 부분이 syntax_linear 함수로 통합. 이 부분은 단순 루프기 때문에 속도가 아마 10-20% 정도 향상되리라 기대한다.
* 소스를 드디어(..) 분리. ''wiki.php(액션별 처리), wikiengine.php(파싱), wikipage.php(페이지), wikiutil.php(일반함수)'' 아무래도 lib 같은 디렉토리에 몰아 넣는 게 더 나은 것 같기도...
!!!!!! theme: TiniWikiDefault version 0.11d
* ul, ol 태그에 대한 CSS 코드 추가

!!!! version 0.1.-171 ''(2004/03/09)''
* HTML 태그 파싱 기능 추가! -_-; ''XHTML로 자동으로 변환하는 기능이 있으며, 블록 태그가 입력되었을 경우 자동으로 열고 닫는다. 안 닫힌 태그에 대한 처리는 다음 버전에서...''
* &amp;nbsp; 엔티티 추가. -_-

!!!! version 0.1.-172 ''(2004/03/08)''
* diff 액션 구현 'ㅡ')/
* info 액션에서 페이지가 없을 경우 에러가 나는 문제 해결.
!!!!!! theme: TiniWikiDefault version 0.11c
* diff 액션을 위한 페이지 추가;
* 오페라에서 body 태그의 margin이 제대로 설정되지 않는 문제 해결. (user agent 보고 꽁수로 끼워 넣기-_-)

!!!! version 0.1.-176
* edit 액션에 preview 기능 추가! :)
!!!!!! theme: TiniWikiDefault version 0.11b
* MSIE에서 좀 맛이 가서 보이는 것을 수정함. -_-; (사실은 MSIE는 쳐다 보기도 싫다만...)

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
!!!!!! plugin: RecentChanges version 0.05
* 드디어 추가 'ㅡ')/
!!!!!! plugin: AllPages version 0.09
* 디자인 조금 바꾸고 파일 구조 바뀐 거에 따라 수정.
* 이름 순서대로 정렬해서 출력하도록 했다.
!!!!!! theme: TiniWikiDefault version 0.11a
* edit.php에서 \</p> 빼먹어서 XHTML 1.1에 안 맞는 거 수정. -_-;;
* goto 액션을 위한 폼 추가
* 글꼴 크기를 조정해서 이상하게 나오는 걸 막았다. (17pt가 이상하게 나오더군...)

!!!!! version 0.1.-180/BETA12 ''(2004/03/06)''
* page history 기능 지원. 쩝쩝...
* netlink에서 엄청난 실수를 바로 잡음. a 태그가 두 번 묶이는 경우가 발생할 수 있다.
* 파일 구조를 조금 바꿨다. php가 작동하는 웹 서버에서는 해당 파일을 볼 수 없다. ($``wikiDataEscape 변수에 있는 내용이 처음 헤더에 들어 간다.)
!!!!!! plugin: AllPages version 0.08c
* 파일 구조 바뀐 대로 수정.
!!!!!! plugin: WikiEgg version 0.021
* 이스터 에그랍시고 집어 넣은 테스트용 플러그인.
* (0.02 -> 0.021) \\x04가 두 개 들어 가 있어서 하나가 파싱되지 않고 남는 버그 해결. (MSIE에서는 보이고 Mozilla에선 안 보인다.)
!!!!!! theme: TiniWikiDefault version 0.11
* 스타일 시트를 조금 변경하였다. 제목에 색깔 들어 간다 :)
* 아이콘을 집어 넣었다.
* info.php 추가.

!!!!! version 0.1.-187b
* 파일 구조 확정. 이름 체계 바꾸다.
!!!!!! plugin: AllPages version 0.08b
* 이름 체계 바뀐 거에 맞춰서 프로그램 고치고 플러그인 포맷 조금 바꿈.

!!!! version 0.1.-187 ''(2004/03/03)''
* entity parsing 기능 추가. tiniwiki.version과 세 개의 HTML entity를 집어 넣었다. 무시할 때는 &amp;tiniwiki.version;이나 \&tiniwiki.version; 이렇게 하면 된다 :)

!!!! version 0.1.-189
* 아니다. netlink 안 고쳤다. 고쳐 놓고 보니까 \\가 anchor에 들어 있을 경우의 해결책이 상당히 혼잡스러운데, 나중에 고치자. 귀찮아 죽겠다.

!!!! version 0.1.-190 ''(2004/03/02)''
* bracket link가 한 줄에 둘 이상 있을 때 anchor가 달린 것이 있을 경우 링크가 잘못 해석 되는 문제를 해결. 하는 김에 syntax_link 함수를 확 뒤엎어서 좀 더 빠르고 깔끔하게 고쳤다. link는 이제 끝! 'ㅡ')/
* 테마 기능 추가. (덤으로 모든 태그에 class 추가)
!!!!!! theme: TiniWikiDefault version 0.1
* 첫번째 TiniWiki 테마 :)

!!!! version 0.1.-196 ''(2004/03/01)''
* syntax_parsing 함수 고침. 자동으로 줄 구분 문자 인식해서 그걸로 쭉 밀고(..) 나간다.

!!!! version 0.1.-197
* heading 기능 추가. 아직 목차 기능 구현 안 했다.

!!! version 0.1.-200
* link의 anchor 부분에 존재하는 버그 해결. 진짜로 0.1.-2xx 대의 마지막 버전.

!!!! version 0.1.-201
* 0.1.-2xx 대의 마지막 버전''(이라고 생각했다)''. |를 사용해서 링크의 anchor를 바꿀 수 있다.

!!!! version 0.1.-207
* 파일명 지정 방법 변경....했다가 다시 고쳤다. -_-;
!!!!!! plugin: AllPages version 0.08a
* 파일명 지정 방법 변경.

!!!! version 0.1.-209
* netlink 기능 추가!!! 삽질 끝에 syntax_escape() 함수의 버그 발견 -_-;
* syntax_escape(): $``netLink 변수 앞에는 \`가 아니라 \`\`를 붙이게 바꿈.
* \`의 기능 확정. 단어 중간의 \`는 무조건 split이다. escape는 \`\`를 써야 한다.

!!!! version 0.1.-215 ''(2004/02/29)''
* 한 줄에 ---만 넣으면 줄이 그어진다.

!!!! version 0.1.-217
* 플러그인을 별도의 파일로 분리함.

!!!! version 0.1.-219
* 인터위키 기능 작동. 문제 있을 수 있으므로 좀 테스트 해 봐야 한다. --> 현재 정상 작동 중

!!!! version 0.1.-228
* 드디어-_- \<pre> 태그와 \<tt> 태그가 작동한다!
* _elaspedtime() 함수 추가. 시간 대충 봤는데 아직까진 괜찮다. 0.00x초 단위니.

!!!! version 0.1.-240
* 문단 별로 \<p>가 나뉘게 고침. -_-

!!!! version 0.1.-241
* base64_encode()를 쓰던 페이지 저장 방식을 rawurlencode()로 변경

!!!! version 0.1.-243
* 약간의 개삽질로 \`로 escape하는 기능이 작동하기 시작.

!!!! version 0.1.-260
* \%%%가 작동한다!

!!!! version 0.1.-263
* 플러그인 기능 추가.
!!!!!! plugin: AllPages version 0.08
* AllPages 플러그인 심심해서 추가(..)

!!!! version 0.1.-269
* ''기울게'', __굵게__, [링크] 기능 작동.
* \\를 사용한 escape 작동

!!! TiniWiki version 0.1.-300 ''(2003/02/26 - 2003/02/28)''
* 개발 시작. 뼈대만 붙여 놓고 있다.

! tokiWiki version 0.0 ''(2002/10/17)''
* TiniWiki의 전신이 되는 프로그램으로, MySQL을 사용하는 위키 프로그램. (읽기/쓰기만 되고, 문법은 구상이 완전히 되어 있었다)