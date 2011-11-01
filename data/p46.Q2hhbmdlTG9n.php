<?php exit; ?>
Q2hhbmdlTG9n	46	YW5vbnltb3Vz	127.0.0.1	1081867580	
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
''< 이전'' | 0.1.-100 | __현재__ | 0.1.-150 | [이후 >|ChangeLog.2]
}}
 

!!!! version 0.1.-145 ''(2004/04/13)''
* 전처리 함수들의 이름을 preprocess_*로 통일했다. (아래 참고)
* 플러그인 기능 대폭 강화
** 플러그인 미리 읽기 기능 지원. 더 이상 file_exists로 인한 부하는 없을 것이다.
** user action 지원. a.*.php 파일이며 대소문자를 구별한다. 함수 이름은 plugin_a_*와 plugin_ap_* 두 개를 써야 한다. (자세한 사항은 문서로 만들 예정)
** 플러그인 파일 이름 형식과 함수 이름 형식이 바뀌었다. 지금까지의 플러그인은 모두 L-플러그인에 속하므로 이름엔 l.이 붙어야 하고, 함수명은 plugin_l_로 시작해야 한다.
* 이미지 출력 문법 추가. \[[|주소|]] 혹은 \[[|주소|설명|]] 형식으로 사용한다.
* 버그 잡이
** \</p> 직전에 다른 태그가 따라 나오는 줄이 삭제되는-_- 어처구니 없는 버그 수정.
** 저번에 syntax_linear 고칠 때 잘못 고쳐서 두 줄 이상 연속되는 정의 목록이 깨졌다. 역시 고쳤다 T_T
** '가 들어 있는 경로가 제대로 인식되지 않던 문제 (%27이 아니라 그냥 ') 해결.
** %0A 등 ASCII 32를 제외한 공백 문자가 제대로 인식되지 않아서 preprocess_parse_path 함수의 정규표현식이 제대로 인식되지 못 하는 문제가 발생했다. 역시 해결.
* __plugin: AllPages version 0.09d__
** 플러그인 기능에 맞춰 파일 이름과 함수명을 바꿈.
* __plugin: RecentChanges version 0.05d__
** 위와 같음
* __plugin: WikiEgg version 0.025__
** 위와 같음(...)
** 크레딧 페이지 추가 -_-;
* __plugin: doit action version 0.01__
** 만들었다!!!!!
** 사용 방법: [[&path;/&pagename.url;?doit=it's%20__TiniWiki%20syntax!__%20'':)'']]

!!!! version 0.1.-148
* 빈 줄 삭제 기능을 약간 고쳐서 플러그인만 있는 문단의 끝에 나오는 빈 줄도 지우게 했음. (\\n만으로 이루어진 빈 줄도 지우게 했다. 사실 \\n만으로 이루어진 문단을 사용자가 문법 만으로 만들 순 없잖는가. -_-)
* syntax_linear 함수 아주 약간 고침. -_-;
* __plugin: AllPages version 0.09c2__
** 내가 바보였다. 플러그인이 출력된 후 그 바로 다음 p 태그에 class가 지정되어 있지 않아서 이상하게 출력되던 문제 수정. -_-;;;;
* __plugin: RecentChanges version 0.05c2__
** 위와 마찬가지
* __plugin: WikiEgg version 0.021a__
** AllPages와 RecentChanges에선 고쳤던 걸 안 고쳐 놓았다. 앞에 나오는 빈 줄 문제 수정. (이건 한 달 만에 건드는 군)

!!!! version 0.1.-149 ''(2004/04/10)''
* 허억! 존재하지 않는 페이지를 클릭했을 때 동시 수정으로 표시되는 문제 수정. ''wiki.php만 고치고 wikiengine.php는 안 고쳐서 발생했다. -_-''
* 불필요한 빈 p 태그를 삭제하도록 수정했다. 파싱 속도에는 눈꼽만한 영향 밖에 안 준다.
** 이렇게 함으로써 플러그인 앞에 나오던 빈 줄이 사라졌다. (RecentChanges를 확인해 보라!)
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
