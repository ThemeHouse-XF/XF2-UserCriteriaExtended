<?php

namespace ThemeHouse\UserCriteria\Listener;

use XF\Entity\User;
use XF\Util\Color;

/**
 * Class CriteriaUser
 * @package ThemeHouse\UserCriteria\Listener
 */
class CriteriaUser
{
    /**
     * @param $rule
     * @param array $data
     * @param User $user
     * @param $returnValue
     * @return null
     */
    public static function criteriaUser($rule, array $data, User $user, &$returnValue)
    {
        /** @var \ThemeHouse\UserCriteria\XF\Entity\User $user */

        $prefix = \XF::options()->thusercriteria_prefix;
        switch ($rule) {
            case $prefix . 'without_about_you':
                if (empty($user->Profile->about)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'with_about_you':
                if (!empty($user->Profile->about)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'without_signature':
                if (empty($user->Profile->signature)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'with_signature':
                if (!empty($user->Profile->signature)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'without_website':
                if (!empty($user->Profile->website)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'with_website':
                if (!empty($user->Profile->website)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_open_reports':
                if ($user->thuc_open_report_count >= $data[$prefix . 'report_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_open_reports':
                if ($user->thuc_open_report_count <= $data[$prefix . 'report_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_closed_reports':
                if ($user->thuc_closed_report_count >= $data[$prefix . 'report_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_closed_reports':
                if ($user->thuc_closed_report_count <= $data[$prefix . 'report_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_reports':
                if ($user->thuc_report_count >= $data[$prefix . 'report_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_reports':
                if ($user->thuc_report_count <= $data[$prefix . 'report_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_active_warnings':
                if ($user->thuc_active_warning_count >= $data[$prefix . 'warn_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_active_warnings':
                if ($user->thuc_active_warning_count <= $data[$prefix . 'warn_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_expired_warnings':
                if ($user->thuc_expired_warning_count >= $data[$prefix . 'warn_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_expired_warnings':
                if ($user->thuc_expired_warning_count <= $data[$prefix . 'warn_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_warnings_recieved':
                if ($user->thuc_warning_count >= $data[$prefix . 'warn_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_warnings_recieved':
                if ($user->thuc_warning_count <= $data[$prefix . 'warn_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_warning_points':
                if ($user->warning_points <= $data[$prefix . 'warn_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_warning_points':
                if ($user->warning_points > $data[$prefix . 'warn_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'user_state_not':
                if ($user->user_state !== $data['state']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_connected_accounts':
                foreach ($data['provider_ids'] as $providerId) {
                    if (isset($user->Profile->connected_accounts[$providerId])) {
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'not_language':
                if ($user->language_id !== $data['language_id']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'registered_max_days':
                if ($user->register_date) {
                    $daysRegistered = floor((time() - $user->register_date) / 86400);
                    if ($daysRegistered <= $data['days']) {
                        $returnValue = true;
                    }
                }
                break;

            case $prefix . 'user_title':
                if ($user->custom_title) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'no_user_title':
                if (!$user->custom_title) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'tags':
                if ($user->thuc_tag_count >= $data['tags']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_tags':
                if ($user->thuc_tag_count <= $data['tags']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'threads':
                if ($user->thuc_thread_count >= $data['threads']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_threads':
                if ($user->thuc_thread_count <= $data['threads']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'following':
                if (count($user->Profile->following) >= $data['following']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_following':
                if (count($user->Profile->following) <= $data['following']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'ignoring':
                if (count($user->Profile->ignored) >= $data['ignored']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_ignoring':
                if (count($user->Profile->ignored) <= $data['ignored']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'follower':
                if ($user->thuc_follower_count >= $data['followers']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_follower':
                if ($user->thuc_follower_count <= $data['followers']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'always':
                $returnValue = true;
                break;

            case $prefix . 'never':
                $returnValue = false;
                break;

            case $prefix . 'not_username':
                $names = preg_split('/\s*,\s*/', utf8_strtolower($data['names']), -1, PREG_SPLIT_NO_EMPTY);
                if (!in_array(utf8_strtolower($user->username), $names)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_username_search':
                if (self::findNeedle($data['needles'], $user->username) === false) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'email_not_search':
                if (self::findNeedle($data['needles'], $user->email) === false) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'bookmarks':
                if ($user->thuc_bookmark_count >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_bookmarks':
                if ($user->thuc_bookmark_count < $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_media_count':
                if (!empty(\XF::app()->container('addon.cache')['XFMG'])) {
                    if (isset($user->xfmg_media_count) && $user->xfmg_media_count <= $data['media_items']) {
                        $returnValue = true;
                    }
                }
                break;

            case $prefix . 'max_album_count':
                if (!empty(\XF::app()->container('addon.cache')['XFMG'])) {
                    if (isset($user->xfmg_album_count) && $user->xfmg_album_count <= $data['albums']) {
                        $returnValue = true;
                    }
                }
                break;

            case $prefix . 'max_resources':
                if (!empty(\XF::app()->container('addon.cache')['XFRM'])) {
                    if (isset($user->xfrm_resource_count) && $user->xfrm_resource_count <= $data['resources']) {
                        $returnValue = true;
                    }
                }
                break;

            case $prefix . 'max_trophy_points':
                if (isset($user->trophy_points) && $user->trophy_points <= $data['points']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'style_ids':
                if (!empty($data['style_ids']) && in_array(\XF::visitor()->style_id, $data['style_ids'])) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_style_ids':
                if (!empty($data['style_ids']) && !in_array(\XF::visitor()->style_id, $data['style_ids'])) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'language_ids':
                if (!empty($data['language_ids']) && in_array(\XF::visitor()->language_id, $data['language_ids'])) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_language_ids':
                if (!empty($data['language_ids']) && !in_array(\XF::visitor()->language_id, $data['language_ids'])) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'username_regex':
                if (@preg_match($data['regex'], $user->username)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_username_regex':
                if (!@preg_match($data['regex'], $user->username)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'user_title_regex':
                if (@preg_match($data['regex'], $user->custom_title)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_user_title_regex':
                if (!@preg_match($data['regex'], $user->custom_title)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'num_connected_accounts':
                if (count($user->Profile->connected_accounts) >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'num_max_connected_accounts':
                if (count($user->Profile->connected_accounts) <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'staff':
                if ($user->is_staff) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_staff':
                if (!$user->is_staff) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'password_min_age':
                if (floor((\XF::$time - $user->Profile->password_date) / 86400) >= $data['days']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'password_max_age':
                if (floor((\XF::$time - $user->Profile->password_date) / 86400) <= $data['days']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'location':
                if ($user->Profile->location) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_location':
                if (!$user->Profile->location) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'birth_day':
                $birthday = $user->Profile->getBirthday(true);
                /** @noinspection PhpUndefinedMethodInspection */
                if (!empty($birthday['timeStamp']) && $birthday['timeStamp']->format('j') == $data['day']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'birth_month':
                $birthday = $user->Profile->getBirthday(true);
                /** @noinspection PhpUndefinedMethodInspection */
                if (!empty($birthday['timeStamp']) && $birthday['timeStamp']->format('n') == $data['month']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'birth_year':
                $birthday = $user->Profile->getBirthday(true);
                /** @noinspection PhpUndefinedMethodInspection */
                if (!empty($birthday['timeStamp']) && $birthday['timeStamp']->format('Y') == $data['year']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'user_upgrades':
                if ($user->thuc_has_active_user_upgrade) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_user_upgrades':
                if (!$user->thuc_has_active_user_upgrade) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_expired_user_upgrades':
                if ($user->thuc_expired_user_upgrade_count >= $data['upgrades']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_expired_user_upgrades':
                if ($user->thuc_expired_user_upgrade_count <= $data['upgrades']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'user_upgrade_expiring_in':
                if ($user->thuc_next_user_upgrade_expiry_date && floor($user->thuc_next_user_upgrade_expiry_date / 86400) <= $data['days']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'push_notifications':
                if ($user->thuc_has_push_subscription) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_push_notifications':
                if (!$user->thuc_has_push_subscription) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'super_administrator':
                if ($user->thuc_is_super_admin) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_super_administrator':
                if (!$user->thuc_is_super_admin) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'api_key':
                if ($user->thuc_has_api_key) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_api_key':
                if (!$user->thuc_has_api_key) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_react_score':
                if ($user->reaction_score <= $data['reactions']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_react_ratio':
                if (!$user->message_count || !$user->reaction_score) {
                    return false;
                }

                $ratio = $user->reaction_score / $user->message_count;
                $returnValue = $ratio <= $data['ratio'];
                break;

            case $prefix . 'unread_conversations':
                if ($user->conversations_unread >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_unread_conversations':
                if ($user->conversations_unread <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'polls':
                if (\XF::db()->fetchOne('SELECT count(*) FROM themehouse.xf_poll_vote WHERE user_id = ?',
                        [$user->user_id]) >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_polls':
                if (\XF::db()->fetchOne('SELECT count(*) FROM themehouse.xf_poll_vote WHERE user_id = ?',
                        [$user->user_id]) <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'user_visible':
                if ($user->activity_visible) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'user_invisible':
                if (!$user->activity_visible) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_threads_watched':
                if ($user->getThucWatchCountForContent('threads') >= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_threads_watched':
                if ($user->getThucWatchCountForContent('threads') <= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_forums_watched':
                if ($user->getThucWatchCountForContent('forums') >= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_forums_watched':
                if ($user->getThucWatchCountForContent('forums') <= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_categories_watched':
                if ($user->getThucWatchCountForContent('xfrm_categories') >= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_categories_watched':
                if ($user->getThucWatchCountForContent('xfrm_categories') <= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_resources_watched':
                if ($user->getThucWatchCountForContent('xfrm_resources') >= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_resources_watched':
                if ($user->getThucWatchCountForContent('xfrm_resources') <= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_categories_watched':
                if ($user->getThucWatchCountForContent('xfmg_categories') >= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_categories_watched':
                if ($user->getThucWatchCountForContent('xfmg_categories') <= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_albums_watched':
                if ($user->getThucWatchCountForContent('xfmg_albums') >= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_albums_watched':
                if ($user->getThucWatchCountForContent('xfmg_albums') <= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_media_watched':
                if ($user->getThucWatchCountForContent('xfmg_media') >= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_media_watched':
                if ($user->getThucWatchCountForContent('xfmg_media') <= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'has_trophy':
                if (!empty(array_intersect($user->thuc_trophy_ids, array_map("intval", $data['trophies'])))) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'has_not_trophy':
                if (empty(array_intersect($user->thuc_trophy_ids, array_map("intval", $data['trophies'])))) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'has_trophies':
                $earntTrophies = $user->thuc_trophy_ids;
                $needsTrophies = array_map("intval", $data['trophies']);
                $earntNeededTrophies = array_intersect($needsTrophies, $earntTrophies);

                sort($earntNeededTrophies);
                sort($needsTrophies);

                if ($earntNeededTrophies == $needsTrophies) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_replies':
                if ($user->thuc_thread_reply_total_count >= $data['replies']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_replies':
                if ($user->thuc_thread_reply_total_count <= $data['replies']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_reply_max':
                if ($user->thuc_thread_reply_max_count >= $data['replies']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_reply_max':
                if ($user->thuc_thread_reply_max_count <= $data['replies']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_profile_posts':
                if ($user->thuc_profile_post_count >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_profile_posts':
                if ($user->thuc_profile_post_count <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_profile_post_comments':
                if ($user->thuc_profile_post_comment_count >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_profile_post_comments':
                if ($user->thuc_profile_post_comment_count <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_attachments':
                if ($user->thuc_attachment_count >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_attachments':
                if ($user->thuc_attachment_count <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_forum_threads_oneof':
                foreach ($data['nodes'] as $nodeId) {
                    if ($user->getThucNodeThreadCount($nodeId) >= $data['threads']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'max_forum_threads_oneof':
                foreach ($data['nodes'] as $nodeId) {
                    if ($user->getThucNodeThreadCount($nodeId) <= $data['threads']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'min_forum_threads_combined':
                $total = 0;
                foreach ($data['nodes'] as $nodeId) {
                    $total += $user->getThucNodeThreadCount($nodeId);
                }
                if ($total >= $data['threads']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_forum_threads_combined':
                $total = 0;
                foreach ($data['nodes'] as $nodeId) {
                    $total += $user->getThucNodeThreadCount($nodeId);
                }
                if ($total <= $data['threads']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_forum_threads_each':
                foreach ($data['nodes'] as $nodeId) {
                    if ($user->getThucNodeThreadCount($nodeId) < $data['threads']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'max_forum_threads_each':
                foreach ($data['nodes'] as $nodeId) {
                    if ($user->getThucNodeThreadCount($nodeId) > $data['threads']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'min_forum_posts_oneof':
                foreach ($data['nodes'] as $nodeId) {
                    if ($user->getThucNodePostCount($nodeId) >= $data['posts']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'max_forum_posts_oneof':
                foreach ($data['nodes'] as $nodeId) {
                    if ($user->getThucNodePostCount($nodeId) <= $data['posts']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'min_forum_posts_combined':
                $total = 0;
                foreach ($data['nodes'] as $nodeId) {
                    $total += $user->getThucNodePostCount($nodeId);
                }
                if ($total >= $data['posts']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_forum_posts_combined':
                $total = 0;
                foreach ($data['nodes'] as $nodeId) {
                    $total += $user->getThucNodePostCount($nodeId);
                }
                if ($total <= $data['posts']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_forum_posts_each':
                foreach ($data['nodes'] as $nodeId) {
                    if ($user->getThucNodePostCount($nodeId) < $data['posts']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'max_forum_posts_each':
                foreach ($data['nodes'] as $nodeId) {
                    if ($user->getThucNodePostCount($nodeId) > $data['posts']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'min_reactions_received_oneof':
                foreach ($data['reactions'] as $reactionId) {
                    if ($user->getThucReceivedReactionCount($reactionId) >= $data['count']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'max_reactions_received_oneof':
                foreach ($data['reactions'] as $reactionId) {
                    if ($user->getThucReceivedReactionCount($reactionId) <= $data['count']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'min_reactions_given_oneof':
                foreach ($data['reactions'] as $reactionId) {
                    if ($user->getThucGivenReactionCount($reactionId) >= $data['count']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'max_reactions_given_oneof':
                foreach ($data['reactions'] as $reactionId) {
                    if ($user->getThucGivenReactionCount($reactionId) <= $data['count']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'min_reactions_given_combined':
                $total = 0;
                foreach ($data['reactions'] as $reactionId) {
                    $total += $user->getThucGivenReactionCount($reactionId);
                }
                if ($total >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_reactions_given_combined':
                $total = 0;
                foreach ($data['reactions'] as $reactionId) {
                    $total += $user->getThucGivenReactionCount($reactionId);
                }
                if ($total <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_reactions_received_combined':
                $total = 0;
                foreach ($data['reactions'] as $reactionId) {
                    $total += $user->getThucReceivedReactionCount($reactionId);
                }
                if ($total >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_reactions_received_combined':
                $total = 0;
                foreach ($data['reactions'] as $reactionId) {
                    $total += $user->getThucReceivedReactionCount($reactionId);
                }
                if ($total <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_reactions_received_each':
                foreach ($data['reactions'] as $reactionId) {
                    if ($user->getThucReceivedReactionCount($reactionId) < $data['count']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'max_reactions_received_each':
                foreach ($data['reactions'] as $reactionId) {
                    if ($user->getThucReceivedReactionCount($reactionId) > $data['count']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'min_reactions_given_each':
                foreach ($data['reactions'] as $reactionId) {
                    if ($user->getThucGivenReactionCount($reactionId) < $data['count']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'max_reactions_given_each':
                foreach ($data['reactions'] as $reactionId) {
                    if ($user->getThucGivenReactionCount($reactionId) > $data['count']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'min_posts_in_threads':
                $postCounts = $user->getThucReplyCountsForThreads(array_column($data, 'thread'));

                foreach ($data as $thread) {
                    if (!$thread['thread'] || !$thread['count']) {
                        continue;
                    }

                    if (!$postCounts[$thread['thread']] || $postCounts[$thread['thread']] < $thread['count']) {
                        break 2;
                    }
                }

                $returnValue = true;
                break;

            case $prefix . 'max_posts_in_threads':
                $postCounts = $user->getThucReplyCountsForThreads(array_column($data, 'thread'));

                foreach ($data as $thread) {
                    if (!$thread['thread'] || !$thread['count']) {
                        continue;
                    }

                    if (!$postCounts[$thread['thread']] || $postCounts[$thread['thread']] > $thread['count']) {
                        break 2;
                    }
                }

                $returnValue = true;
                break;

            case $prefix . 'min_xfrm_highest_downloads':
                if ($user->thuc_xfrm_resource_highest_download_count >= $data['downloads']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_highest_downloads':
                if ($user->thuc_xfrm_resource_highest_download_count <= $data['downloads']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_total_downloads':
                if ($user->thuc_xfrm_resource_download_count >= $data['downloads']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_total_downloads':
                if ($user->thuc_xfrm_resource_download_count <= $data['downloads']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_highest_views':
                if ($user->thuc_xfrm_resource_highest_view_count >= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_highest_views':
                if ($user->thuc_xfrm_resource_highest_view_count <= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_total_views':
                if ($user->thuc_xfrm_resource_view_count >= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_total_views':
                if ($user->thuc_xfrm_resource_view_count <= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_highest_rating':
                if ($user->thuc_xfrm_resource_highest_rating >= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_highest_rating':
                if ($user->thuc_xfrm_resource_highest_rating <= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_average_rating':
                if ($user->thuc_xfrm_resource_average_rating >= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_average_rating':
                if ($user->thuc_xfrm_resource_average_rating <= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_updates':
                if ($user->thuc_xfrm_resource_update_count >= $data['updates']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_updates':
                if ($user->thuc_xfrm_resource_update_count <= $data['updates']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_reviews':
                if ($user->thuc_xfrm_resource_review_count >= $data['reviews']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_reviews':
                if ($user->thuc_xfrm_resource_review_count <= $data['reviews']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_given_reviews':
                if ($user->thuc_xfrm_resource_given_review_count >= $data['reviews']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_given_reviews':
                if ($user->thuc_xfrm_resource_given_review_count <= $data['reviews']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_album_views':
                if ($user->thuc_xfmg_album_view_count >= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_album_views':
                if ($user->thuc_xfmg_album_view_count <= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_album_highest_views':
                if ($user->thuc_xfmg_album_highest_view_count >= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_album_highest_views':
                if ($user->thuc_xfmg_album_highest_view_count <= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_media_item_views':
                if ($user->thuc_xfmg_media_item_view_count >= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_media_item_views':
                if ($user->thuc_xfmg_media_item_view_count <= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_media_item_highest_views':
                if ($user->thuc_xfmg_media_item_highest_view_count >= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_media_item_highest_views':
                if ($user->thuc_xfmg_media_item_highest_view_count <= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_album_comments':
                if ($user->thuc_xfmg_album_comment_count >= $data['comments']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_album_comments':
                if ($user->thuc_xfmg_album_comment_count <= $data['comments']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_album_highest_comments':
                if ($user->thuc_xfmg_album_highest_comment_count >= $data['comments']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_album_highest_comments':
                if ($user->thuc_xfmg_album_highest_comment_count <= $data['comments']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_media_item_comments':
                if ($user->thuc_xfmg_media_item_comment_count >= $data['comments']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_media_item_comments':
                if ($user->thuc_xfmg_media_item_comment_count <= $data['comments']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_media_item_highest_comments':
                if ($user->thuc_xfmg_media_item_highest_comment_count >= $data['comments']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_media_item_highest_comments':
                if ($user->thuc_xfmg_media_item_highest_comment_count <= $data['comments']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_highest_album_rating':
                if ($user->thuc_xfmg_album_highest_rating >= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_highest_album_rating':
                if ($user->thuc_xfmg_album_highest_rating <= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_average_album_rating':
                if ($user->thuc_xfmg_album_average_rating >= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_average_album_rating':
                if ($user->thuc_xfmg_album_average_rating <= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_highest_item_rating':
                if ($user->thuc_xfmg_media_item_highest_rating >= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_highest_item_rating':
                if ($user->thuc_xfmg_media_item_highest_rating <= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_average_item_rating':
                if ($user->thuc_xfmg_media_item_average_rating >= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_average_item_rating':
                if ($user->thuc_xfmg_media_item_average_rating <= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_album_rating_count':
                if ($user->thuc_xfmg_album_rating_count >= $data['rating']) {
                    $returnValue = true;
                }
                exit;

            case $prefix . 'max_xfmg_album_rating_count':
                if ($user->thuc_xfmg_album_rating_count <= $data['rating']) {
                    $returnValue = true;
                }
                exit;

            case $prefix . 'min_xfmg_album_rating_given_count':
                if ($user->thuc_xfmg_album_rating_given_count >= $data['rating']) {
                    $returnValue = true;
                }
                exit;

            case $prefix . 'max_xfmg_album_rating_given_count':
                if ($user->thuc_xfmg_album_rating_given_count <= $data['rating']) {
                    $returnValue = true;
                }
                exit;

            case $prefix . 'min_xfmg_media_item_rating_count':
                if ($user->thuc_xfmg_media_item_rating_count >= $data['rating']) {
                    $returnValue = true;
                }
                exit;

            case $prefix . 'max_xfmg_media_item_rating_count':
                if ($user->thuc_xfmg_media_item_rating_count <= $data['rating']) {
                    $returnValue = true;
                }
                exit;

            case $prefix . 'min_xfmg_media_item_rating_given_count':
                if ($user->thuc_xfmg_media_item_rating_given_count >= $data['rating']) {
                    $returnValue = true;
                }
                exit;

            case $prefix . 'max_xfmg_media_item_rating_given_count':
                if ($user->thuc_xfmg_media_item_rating_given_count <= $data['rating']) {
                    $returnValue = true;
                }
                exit;

            case $prefix . 'min_resource_category_oneof':
                foreach ($data['categories'] as $categoryId) {
                    if ($user->getThucXfrmResourceCountForCategory($categoryId) >= $data['count']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'max_resource_category_oneof':
                foreach ($data['categories'] as $categoryId) {
                    if ($user->getThucXfrmResourceCountForCategory($categoryId) <= $data['count']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'min_resource_category_combined':
                $total = 0;
                foreach ($data['categories'] as $categoryId) {
                    $total += $user->getThucXfrmResourceCountForCategory($categoryId);
                }
                if ($total <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_resource_category_combined':
                $total = 0;
                foreach ($data['categories'] as $categoryId) {
                    $total += $user->getThucXfrmResourceCountForCategory($categoryId);
                }
                if ($total >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_resource_category_each':
                foreach ($data['categories'] as $categoryId) {
                    if ($user->getThucXfrmResourceCountForCategory($categoryId) < $data['count']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'max_resource_category_each':
                foreach ($data['categories'] as $categoryId) {
                    if ($user->getThucXfrmResourceCountForCategory($categoryId) > $data['count']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'min_media_item_category_oneof':
                foreach ($data['categories'] as $categoryId) {
                    if ($user->getThucXfmgItemCountForCategory($categoryId) >= $data['count']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'max_media_item_category_oneof':
                foreach ($data['categories'] as $categoryId) {
                    if ($user->getThucXfmgItemCountForCategory($categoryId) <= $data['count']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'min_media_item_category_combined':
                $total = 0;
                foreach ($data['categories'] as $categoryId) {
                    $total += $user->getThucXfmgItemCountForCategory($categoryId);
                }
                if ($total <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_media_item_category_combined':
                $total = 0;
                foreach ($data['categories'] as $categoryId) {
                    $total += $user->getThucXfmgItemCountForCategory($categoryId);
                }
                if ($total >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_media_item_category_each':
                foreach ($data['categories'] as $categoryId) {
                    if ($user->getThucXfmgItemCountForCategory($categoryId) < $data['count']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'max_media_item_category_each':
                foreach ($data['categories'] as $categoryId) {
                    if ($user->getThucXfmgItemCountForCategory($categoryId) > $data['count']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            default:
                $prefixLength = strlen($prefix) + 11;
                if (substr($rule, 0, $prefixLength) === $prefix . 'user_field_') {
                    self::criteriaCustom(explode('_', substr($rule, $prefixLength)), $data, $user, $returnValue);
                }
                break;
        }

        return null;
    }

    /**
     * @param $needleList
     * @param $haystack
     * @return bool
     */
    protected static function findNeedle($needleList, $haystack)
    {
        $haystack = utf8_strtolower($haystack);

        foreach (preg_split('/\s*,\s*/', utf8_strtolower($needleList), -1, PREG_SPLIT_NO_EMPTY) as $needle) {
            if (strpos($haystack, $needle) !== false) {
                return $needle;
            }
        }

        return false;
    }

    /**
     * @param array $ruleInput
     * @param array $data
     * @param User $user
     * @param $returnValue
     */
    public static function criteriaCustom(array $ruleInput, array $data, User $user, &$returnValue)
    {
        $rule = array_shift($ruleInput);
        $field = join('_', $ruleInput);
        $value = $user->Profile->custom_fields[$field];

        switch ($rule) {
            case 'checked':
                if ($value) {
                    $returnValue = true;
                }
                break;

            case 'unchecked':
                if (!$value) {
                    $returnValue = true;
                }
                break;

            case 'preg-match':
                if (@preg_match($data['regex'], $value)) {
                    $returnValue = true;
                }
                break;

            case 'radio-below':
                if ($value < $data['threshold']) {
                    $returnValue = true;
                }
                break;

            case 'radio-above':
                if ($value > $data['threshold']) {
                    $returnValue = true;
                }
                break;

            case 'email-domain':
                $mail = explode('@', $value);
                $domain = array_pop($mail);
                if ($domain === $data['text']) {
                    $returnValue = true;
                }
                break;

            case 'color-red-above':
                $color = self::parseColor($value);

                if ($color[0] > $data['value']) {
                    $returnValue = true;
                }
                break;

            case 'color-green-above':
                $color = self::parseColor($value);

                if ($color[1] > $data['value']) {
                    $returnValue = true;
                }
                break;

            case 'color-blue-above':
                $color = self::parseColor($value);

                if ($color[2] > $data['value']) {
                    $returnValue = true;
                }
                break;

            case 'color-red-below':
                $color = self::parseColor($value);

                if ($color[0] < $data['value']) {
                    $returnValue = true;
                }
                break;

            case 'color-green-below':
                $color = self::parseColor($value);

                if ($color[1] < $data['value']) {
                    $returnValue = true;
                }
                break;

            case 'color-blue-below':
                $color = self::parseColor($value);

                if ($color[2] < $data['value']) {
                    $returnValue = true;
                }
                break;

            case 'date-day-equals':
                $date = explode('-', $value);
                if (+$date[2] === +$data['day']) {
                    $returnValue = true;
                }
                break;


            case 'date-month-equals':
                $date = explode('-', $value);
                if (+$date[1] === +$data['month']) {
                    $returnValue = true;
                }
                break;


            case 'date-year-equals':
                $date = explode('-', $value);
                if (+$date[0] === +$data['year']) {
                    $returnValue = true;
                }
                break;

            case 'date-before':
                $date = strtotime($value);
                $target = strtotime($data['date']);
                if ($date < $target) {
                    $returnValue = true;
                }
                break;

            case 'date-after':
                $date = strtotime($value);
                $target = strtotime($data['date']);
                if ($date > $target) {
                    $returnValue = true;
                }
                break;

            default:
                break;
        }
    }

    /**
     * @param $color
     * @return array
     */
    protected static function parseColor($color)
    {
        if (@preg_match('/\#([0-9A-F]{3,6})/xi', $color, $matches)) {
            return Color::hexToRgb($matches[1]);
        }
        if (@preg_match('/rgba?\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3})/xi', $color, $matches)) {
            return [$matches[1], $matches[2], $matches[3]];
        } elseif (@preg_match('/hsl\(([0-2]?[0-9]?[0-9]|3[0-5][0-9]|360)\s*,([0-9]?[0-9]|100)%\s*,([0-9]?[0-9]|100)%/xi',
            $color, $matches)) {
            return Color::hslToRgb($matches[1], $matches[2], $matches[3]);
        } else {
            $namedColors = Color::getNamedColors();

            if (isset($namedColors[$color])) {
                return self::parseColor($namedColors[$color]);
            } else {
                return [0, 0, 0];
            }
        }
    }
}
