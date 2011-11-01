<?php exit; ?>
d2lraVBsdWdpbi9SZWNlbnRDaGFuZ2Vz	4	YW5vbnltb3Vz	127.0.0.1	1081590560	
! plugin: RecentChanges version 0.05c2

최근에 수정된 페이지들의 목록을 출력하는 플러그인입니다. (좀 더 정확하게 말하면, 최근에 수정된 순서대로 페이지들을 출력합니다.)

RecentChanges 페이지에서 이 플러그인을 쓰고 있습니다.

!! 설치법

이 플러그인은 TiniWiki에 기본적으로 포함되어 있습니다.

!! 사용법

적당한 곳에 다음과 같이 입력합니다.

{{
\<?RecentChanges>
}}

!! 속성

이 플러그인에는 속성이 하나 있습니다.

!!! number

출력할 페이지 갯수입니다. 이 갯수보다 페이지가 적다면 모두 출력하고, 지정하지 않거나 음수일 경우 모두 출력합니다.

{{
\<?RecentChanges number="5">
}}
