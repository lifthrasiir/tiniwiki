<?php exit; ?>
VG9Ebw==	14	YW5vbnltb3Vz	127.0.0.1	1081848210	
! TiniWiki의 다음 버전 계획

이 페이지에서는 TiniWiki에서 나중에 추가될 내용을 다룹니다.

!! 문법 강화

''일단 없음.''

!! 액션 추가

!!! search 액션 ''(0.1.-145?)''
파일 DB로 시작하면서 내가 가장 걱정했던 것이 검색이었다. -_- 아마 가장 최악의 속도를 보여 주지 않을까 하는 생각이 드는데... 일단 기능은 있어야 한다.

!! 플러그인 추가

!!! Calendar 플러그인
wikiX와 UseModWiki에 있는 것. 빨랑 만들어야 겠다. -_-

!!!! Lunar2Solar 모듈
만들다가 만 것. 빨리 만들어야 하는데 귀찮아서 지연되고 있다... (Calendar 플러그인은 이 모듈이 만들어 지기 전에 먼저 공개될 것이다.)

!!! SearchPages 플러그인
search 액션이 구현되면 자연히 같이 만들 것이다.

!!! UserPreference 플러그인
아래의 "사용자 기능" 참조.

!!! TableOfContents 플러그인
어렵진 않지만 깔끔하게 처리하기 좀 힘든 부분이 몇 군데 있다.

!!! Macro 플러그인
wikiX에서 편리하게 쓰였던 매크로 기능을 플러그인을 사용해서 구현해 보려 한다. 이 플러그인이 사용 가능하려면 먼저 아래의 "플러그인의 기능 확대"에 있는 내용이 구현되어야 가능한데 언제 될 지는 아무도 모른다. -_-;;

''만약 구현된다면 사용 형식은 <<`MacroName>Argument> 같은 형식이 되지 않을까 추측하고 있다. <<|`MacroName>Definition> 이렇게 하면 등록되게 할까? :S''

!! 기타 기능

!!! 플러그인의 기능 확대 ''(0.1.-140?; 0.1.-145에서 일부 구현)''
개선 사항은 두 가지가 있다.

__플러그인의 범위 지정 기능 추가:__ <?command>와 함께 <?/command> 태그가 사용 가능하게 하는 기능인데, 이 기능을 추가하기 위해서는 어떤 플러그인이 이렇게 사용되는 지 파악할 수 있어야 한다. (즉, 어떤 플러그인이 singleton으로도 쓰이고 끝태그가 있는 경우도 있으면 안 된다.)

__플러그인 적용 위치 결정:__ 파싱 중간 중간에 적당히 넣어 줘야 한다. (wikiX의 확장 기능들은 무려 여섯 개-_-나 그 지점이 설정되어 있다...) 한 세 개 정도의 breakpoint(플러그인을 적용하는)가 있지 않을까 싶은데, 이 역시 쉽지 않은 것이다. 어느 플러그인이 어디서 쓰이는 지 결정할 tag 같은 게 있어야 하는데 골때린다-_-

!!! UTF-8 지원 ''(아직 지원할 필요 없음)''
한글에 관계된 부분이 추가될 경우 UTF-8을 고려하면서 만들어야 한다.

!!! 변경 내용 요약 기능 ''(아직 지원할 "생각" 없음;;)''
이 기능은 맘만 먹으면 구현할 수 있게 이미 짜여 있다. (0.1.-171 현재) tag 필드에 serialize해서 넣으면 문제 없을 것이다.

!!! 사용자 기능 ''(0.1.-150?)''
꼭 있어야 한다. 이것도 일단 필드는 만들어져 있다. 아마도 UserPreference 플러그인이 함께 있어야 할 것 같다.

!!! 파일 업로드 기능 ''(0.1.-150?)''
글쎄... 이것도 구현은 할 건데 충분한 테스트가 있어야 할 것이다.

! 이미 구현된 내용

* __diff 액션:__ 0.1.-172에서 구현
* __HTML 태그 파싱:__ 0.1.-171에서 구현
* __목록/blockquote 파싱:__ 0.1.-168에서 구현
* __정의 목록:__ 0.1.-165에서 구현
* __역링크 구현 (links1/links2 액션):__ 0.1.-157에서 구현!
* __표 기능:__ 0.1.-152에서 구현
* __이미지 출력 문법:__ 0.1.-145에서 구현
